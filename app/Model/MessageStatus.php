<?php
App::uses('AppModel', 'Model');

class MessageStatus extends AppModel {

	public $useTable = "message_status";
	public $userId;

	public function __construct()
	{
		parent::__construct();
		$this->userId = AuthComponent::user('id');
		$this->Message = ClassRegistry::init('Message');

	}

	public function saveMessageStatus($data) {
		$this->create();
		$this->save($data);
	}
}
