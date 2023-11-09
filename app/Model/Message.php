<?php
App::uses('AppModel', 'Model');
use Cake\ORM\TableRegistry;

class Message extends AppModel {
    public $userTable = "messages";
    public $userId;

	public $actsAs = array('Containable');

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'from_id',
        ),
    );

    public function __construct(){
        parent::__construct();
		$this->userId = AuthComponent::user('id');
		$this->profileImage = AuthComponent::user('profile_image');
		$this->MessageStatus = ClassRegistry::init('MessageStatus');

    }

	//  CREATE NEW MESSAGE
    public function createMessage($msgInput){
        foreach ($msgInput["toId"] as $toId) {
            $checkMessageKeyExist = $this->query("SELECT message_key FROM messages WHERE (to_id = $toId AND from_id = $this->userId) OR (to_id = $this->userId AND from_id = $toId)");
            if ($checkMessageKeyExist != null) {
				$saveMsg["message_key"] = $checkMessageKeyExist[0]["messages"]["message_key"];
			} else {
				$saveMsg["message_key"] = $this->userId.''.$toId;
			}
			$saveMsg["to_id"] = $toId;
			$saveMsg["from_id"] = $this->userId;
			$saveMsg["content"] = $msgInput["content"];
            $this->create();
            if($this->save($saveMsg)){
                $saveMsgStatus = array(
                    'message_id' => $this->id,
                    'message_key' => $saveMsg['message_key']
                );
                $saveMsgStatus['user_id'] = $saveMsg['to_id'];
                $this->MessageStatus->saveMessageStatus($saveMsgStatus);

                $saveMsgStatus['user_id'] = $this->userId;
                $this->MessageStatus->saveMessageStatus($saveMsgStatus);
            }
        }
    }

	// GET ALL INIT MESSAGES
    public function getAllMessages($limit, $page){
		// $offset = $limit * $page;
		$offset = ($page - 1) * $limit;
		$messagesList = $this->query(
			"with messages as (
				select messages.id, messages.content, messages.from_id, messages.message_key, messages.created_date, messages.to_id,
					   row_number() over(partition by messages.message_key order by messages.id desc) as RowNum
					from messages LEFT JOIN message_status ON message_status.message_id = messages.id WHERE message_status.user_id = $this->userId AND (messages.from_id = $this->userId OR messages.to_id = $this->userId)
			)
			select *
				from users RIGHT JOIN messages ON users.id = messages.from_id OR users.id = messages.to_id WHERE users.id != $this->userId GROUP BY message_key ORDER BY messages.id DESC LIMIT $limit OFFSET $offset
			"
		);



		return $messagesList;
    }

		// GET ALL INIT MESSAGES
		public function getAllMessagesQuery(){
			$messagesList = $this->query(
				"with messages as (
					select messages.id, messages.content, messages.from_id, messages.message_key, messages.created_date, messages.to_id,
						   row_number() over(partition by messages.message_key order by messages.id desc) as RowNum
						from messages LEFT JOIN message_status ON message_status.message_id = messages.id WHERE message_status.user_id = $this->userId AND (messages.from_id = $this->userId OR messages.to_id = $this->userId)
				)
				select *
					from users RIGHT JOIN messages ON users.id = messages.from_id OR users.id = messages.to_id WHERE users.id != $this->userId GROUP BY message_key ORDER BY messages.id DESC LIMIT 10
				"
			);
			return $messagesList;
		}
	
	// VIEW MESSAGE FROM SENDER AND RECIEVER
    public function viewMessageDetails($recipient, $message_key) {

        $messages = $this->query("SELECT msg.* FROM (
            SELECT messages.id, messages.content, messages.message_key, messages.from_id, messages.to_id, messages.created_date, message_status.user_id
            FROM messages
            LEFT JOIN message_status ON message_status.message_id = messages.id
            WHERE message_status.message_key = ? AND message_status.user_id = ?
            ORDER BY messages.id DESC
            LIMIT 11
        ) AS msg
        ORDER BY msg.id ASC", array($message_key, $this->userId));
        
        return $messages;
    }
    
	// REPLY MESSAGE MODEL
	public function replyMessage($replyContent) {

		$replyContent["from_id"] = $this->userId;
		$this->save($replyContent);

		$saveMsgStatus = array(
			"message_id" => $this->id,
			"message_key" => $replyContent["message_key"],
		);

		// save message status table - user_to
		$saveMsgStatus["user_id"] = $replyContent["to_id"];
		$this->MessageStatus->saveMessageStatus($saveMsgStatus);

		// save message status table - user_from
		$saveMsgStatus["user_id"] = $this->userId;
		$this->MessageStatus->saveMessageStatus($saveMsgStatus);

		if ($this->id != null){
			echo '
				<div class="message-area to-msg">
					<p>'.$replyContent["content"].'<span id="delete-msg" data-msgid="'.$this->id.'"><i class="fa fa-trash"></i></span></p>
				</div>
			';
		} else {
			echo '
				<div class="message-area error-msg">
					<p>Error occured!</p>
				</div>
			';
		}
	}

	// SHOW MORE MESSAGE
	public function viewMessageDetailsPaginate($dataReq, $get_profileimg) {

		$recipient = $dataReq['recipient'];
		$lastMsgId = $dataReq['lastMsgId'];
		$lastMsgIdButton = null;

		$output = "";
		$messages = $this->query(
			"select msg.*FROM
			(
				select *
				from messages
				WHERE (to_id = $recipient AND from_id = $this->userId) OR (to_id = $this->userId AND from_id = $recipient)
				HAVING id < $lastMsgId order by id DESC  limit 11

			) msg LEFT JOIN message_status ON message_status.message_id = msg.id WHERE message_status.user_id = $this->userId
			order by msg.id ASC
			"
		);

		$counter = 0;
		foreach ($messages as $message) {
			$btnShowMore = "";
			if(strlen($message['msg']['content']) >= 50){
				$btnShowMore = '<span id="delete-msg" data-msgid="'.$message['msg']["id"].'"><i class="fa fa-trash"></i></span><a class="text-decoration-underline" onClick="showMoreMsg(this, `'.htmlspecialchars($message['msg']['content']).'`,'.$message['msg']["id"].')">(see more)</a>';
			}else{
				$btnShowMore = '<span id="delete-msg" data-msgid="'.$message['msg']["id"].'"><i class="fa fa-trash"></i></span>';
			}
			if ( count($messages) > 11) {
				if($counter > 0 && $counter <= 11){
					$msg = $message["msg"];
					if ($msg["from_id"] == $recipient) {
						$output .= '
							<div class="message-area from-msg" id="'.$msg["id"].'">
								<figure>
								<img src="'.Router::url('/').DS.'uploads/user_'.$msg['from_id'].DS.'" alt="profile image"">
								</figure>
								<p>'.mb_strimwidth($msg['content'], 0, 50, "...").$btnShowMore.'</p>
								<span class="message_time">'.$this->datetimeFormatMessage($msg['created_date']).'</span>
							</div>
						';
					} else {
						$output .= '
							<div class="message-area to-msg" id="'.$msg["id"].'">
							<figure>
							<img src="'.Router::url('/').DS.'uploads/user_'.$this->userId.DS.$this->profileImage.'" alt="profile image">
							</figure>
								<p>'.mb_strimwidth($msg['content'], 0, 50, "...").$btnShowMore.'</p>
								<span class="message_time">'.$this->datetimeFormatMessage($msg['created_date']).'</span>
							</div>
						';
					}
				}
			} else {
				$msg = $message["msg"];
				if ($msg["from_id"] == $recipient) {
					$output .= '
						<div class="message-area from-msg" id="'.$msg["id"].'">
							<figure>
							<img src="'.Router::url('/').'uploads/user_'.$msg['from_id'].DS.$get_profileimg['profile_image'].'" alt="profile image">
							</figure>
							<p>'.mb_strimwidth($msg['content'], 0, 50, "...").$btnShowMore.'</p>
							<span class="message_time">'.$this->datetimeFormatMessage($msg['created_date']).'</span>
						</div>
					';
				} else {
					$output .= '
						<div class="message-area to-msg" id="'.$msg["id"].'">
							<figure>
							<img src="'.Router::url('/').DS.'uploads/user_'.$this->userId.DS.$this->profileImage.'" alt="profile image">
							</figure>
							<p>'.mb_strimwidth($msg['content'], 0, 50, "...").$btnShowMore.'</p>
							<span class="message_time">'.$this->datetimeFormatMessage($msg['created_date']).'</span>
						</div>
					';
				}
			}
			if ($counter == 1) {
				// last message ID
				$lastMsgIdButton = $msg["id"];
			}
			$counter = $counter + 1;
		}
		if (count($messages) > 10) {
			$output .= '<button class="btn btn-info mx-auto" id="see-older-msg" data-msgid="'.$lastMsgIdButton.'">See older message</button>';
		}
		// returbn ajax //
	
		return $output;
	}

	// FUNCTION FOR DATE TIME FORMAT
	public function datetimeFormatMessage($date_param){
        if($date_param!=null){
            $date_param = date_create($date_param);
            return date_format($date_param,'M d, Y g:ia');
        }else{
            return 'n/a';
        }
    }

	//DELETE ALL MESSAGES
	public function deleteAllMessageWithMk($message_key) {
		$this->deleteAll(array(
			'message_key' => $message_key
		), false);
	}


}
?>