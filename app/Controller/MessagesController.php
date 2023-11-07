<?php

App::uses('AppController', 'Controller');
App::uses('User', 'AppModel');

class MessagesController extends AppController{

	public $uses = array(
		'User',
		'Message',
		'MessageStatus'
	);

	public $components = array('RequestHandler','Flash', 'Session');

	public function __construct($request = null, $response = null)
	{
		parent::__construct($request, $response);
	}

    public function index(){
		$messagesList = $this->Message->getAllMessages();
		$this->set("messages", $messagesList);
    }

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
}

?>