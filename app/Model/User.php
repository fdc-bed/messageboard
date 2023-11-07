<?php 
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{
	public $name = 'User';
    public $validate = array(
        'name' => array(
			'Name is required and should 5-20 Characters' => array(
				'rule' => array('between', 5, 20),
				'message' => 'Name is required and should 5-20 Characters'
			),
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Name is required'
            )
		),
		'email' => array(
			'Valid email' => array(
				'rule' => array('email'),
				'message'=> 'Please enter a valid email address'
			),
			'Email is already exist!' => array(
				'rule' => 'isUnique',
				'message' => 'Email is already exist!'
			),
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
			),
			'Match passwords' => array(
				'rule' => 'matchPasswords',
				'message' => 'Your passwords does not match!'
			)
		),
		'confirm_password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password confirmation is required'
            )
		),
		'birthdate' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Birthdate is required'
			),
			'validAge' => array(
				'rule' => array('isUnderAge', 17),
				'message' => 'You must be at least 17 years old.',
			),

		),
		'gender' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Gender is required'
            )
		),
		'age' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Age is required'
            )
		),
		'hobby' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Hobby is required'
            )
		),
	);

    public function __construct(){
        parent::__construct();
        $this->userID = AuthComponent::user('id');
        $this->userId = $this->userID;
    }

	public function matchPasswords($data) {
		if ($this->data[$this->alias]['password'] == $this->data[$this->alias]['confirm_password']) {
			return true;
		}
		return false;
	}

	public function isUnderAge($value, $minAge) {
		$today = new DateTime();
		$birthdate = new DateTime($value['birthdate']);
	
		$interval = $birthdate->diff($today);
	
		return $interval->y >= $minAge;
	}

	public function beforeSave($options = array()) {
		if (isset($this->data["User"]['password'])) {
			$this->data["User"]['password'] = AuthComponent::password($this->data["User"]['password']);
		}
		return true;
	}
	

	public function getProfileData(){
		$userData = $this->find('first', array(
			'conditions' => array(
				'id' => $this->userID
			)
		));
		
		return $userData;
	}

	public function getUsersToSendMessage() {
		// debug($this->request->params);
		$usersList = $this->find('all', array(
			'conditions' => array(
				'id !=' => $this->userID
			)
		));
		return $usersList;
	}

	// Search Model 
	public function searchUsers($search_string = NULL) {
		// debug($this->request->params);
		$usersList = $this->find('all', array(
			'fields' => array('id', 'name', 'profile_image'),
			'conditions' => array(
				'id !=' => $this->userID,
				'name LIKE' => '%' . $search_string . '%'
			)
		));
		return $usersList;
	}

	public function getUserData($data_id = NULL) {
		$get_user = $this->find('all', array(
			'fields' => array('id', 'name', 'profile_image'),
			'conditions' => array(
				'id' => $data_id
			)
		));
		return $get_user;
	}


}
?>