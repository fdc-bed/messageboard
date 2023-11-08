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

	// SAVE STATUS
	public function saveMessageStatus($data) {
		$this->create();
		$this->save($data);
	}

	// DELETE SINGLE MESSAGE
	public function deleteSingleMessageStatus($msgid) {
		$deleteMessage = $this->deleteAll(array(
			'message_id' => $msgid,
			'user_id' => $this->userId
		), false);

		if ($deleteMessage) {
			echo "Success";
		} else {
			echo "Error";
		}

	}

	// DELETE CONVERSATION MESSAGE
	public function deleteConvoMessage($message_key) {
		$deleteConversationMessage = $this->deleteAll(array(
			'message_key' => $message_key,
			'user_id' => $this->userId
		), false);
		if ($deleteConversationMessage) {
			$countMessageKey = $this->find("all",
				array(
					"conditions" => array(
						"message_key" => $message_key
					)
				)
			);
			if ($countMessageKey == null) {
				$this->Message->deleteAllMessageWithMk($message_key);
			}
			echo "Success";
		} else {
			echo "Error";
		}

	}

}
