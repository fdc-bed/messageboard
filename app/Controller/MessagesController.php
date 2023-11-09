<?php

App::uses('AppController', 'Controller');
App::uses('User', 'AppModel');


class MessagesController extends AppController{

	public $uses = array(
		'User',
		'Message',
		'MessageStatus'
	);

	// COMPONENTS
	public $components = array('RequestHandler','Flash', 'Session');

	// REQUEST CONSTRUCTOR
	public function __construct($request = null, $response = null)
	{
		parent::__construct($request, $response);
	}

	// MESSAGE INDEX
    public function index(){

		$messagesList = $this->Message->getAllMessagesQuery();
		$this->set("messages", $messagesList);
    }

	public function getMessagesMore(){
		$page = $this->request->params['page'];
		$messagesList = $this->Message->getAllMessages(10,$page);
		debug($messagesList);
		$this->render('/Layouts/ajax');
    }



	// CREATE NEW MESSATE
	public function createMessage() {
		$usersToSendMessage = $this->User->getUsersToSendMessage();
		$this->set("users", $usersToSendMessage);
		if (isset($this->request->data) && $this->request->data) {
			$this->Session->setFlash('', 'default', array('class' => 'message_sent'));
			$msgInput = $this->request->data;
			$responseCreateMessage = $this->Message->createMessage($msgInput);
			return $this->redirect(array('controller' => 'Messages', 'action' => 'index'));
		}
	}

	// VIEW MESSAGE
	public function viewMessage() {
		$recipient = $this->request->params['id'];
		$message_key = $this->request->params['message_key'];
		$getRecipientData = $this->User->getUserData($recipient)[0]["User"];
		$listMsg = $this->Message->viewMessageDetails($recipient, $message_key);
		$getRecipientData['message_key'] = $message_key;
		$this->set('recipient', $getRecipientData);
		$this->set('messages', $listMsg);
	}

	// REPLY MESSAGE
	public function replyMessage() {
		if(isset($this->request->data)&& $this->request->data){
			$replyContent = $this->request->data;
			// debug($replyContent);
			$getRecipientData = $this->User->getUserData($replyContent['to_id']);

			if($getRecipientData == null){
				echo '
					<div class="msg-txt error-msg">
						<p>Error occured!</p>
					</div>
				';
			}else{
				$response = $this->Message->replyMessage($replyContent);
			}
		}
		$this->render('/Layouts/ajax');
	}

	//VIEW SEE OLDER MESSAGE
	public function viewMessageDetailsPaginate() {
		if (isset($this->request->data) && $this->request->data) {
			$dataReq = $this->request->data;
		$get_profileimg = $this->User->getUserData($dataReq['recipient'])[0]["User"];
		// debug($getRecipientData);

			$response = $this->Message->viewMessageDetailsPaginate($dataReq,$get_profileimg);
			echo $response;
			$this->render('/Layouts/ajax');
		}
	}

	//DELETE SINGLE MESSAGE
	public function deleteMessage() {
		if (isset($this->request->data) && $this->request->data) {
			$msgid = $this->request->data("msgid");
			// debug($msgid);
			$response = $this->MessageStatus->deleteSingleMessageStatus($msgid);
		}
		$this->render('/Layouts/ajax');
	}
		// DELETE CONVERSATION
		public function deleteMessages() {
			if (isset($this->request->data) && $this->request->data) {
				$message_key = $this->request->data("message_key");
				$response = $this->MessageStatus->deleteConvoMessage($message_key);
			}
			$this->render('/Layouts/ajax');
		}

}

?>