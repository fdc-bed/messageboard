<?php
App::uses('AppModel', 'Model');
use Cake\ORM\TableRegistry;

class Message extends AppModel {
    public $userTable = "messages";
    public $userId;

    public function __construct(){
        parent::__construct();
		$this->userId = AuthComponent::user('id');
		$this->MessageStatus = ClassRegistry::init('MessageStatus');

    }

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

    public function getAllMessages(){
        

    }
}
?>