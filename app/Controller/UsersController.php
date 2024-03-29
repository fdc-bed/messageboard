<?php
App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
use Cake\Http\ServerRequest;

class UsersController extends AppController{
    public $name = 'Users';
	public $components = array('RequestHandler');

	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
	}

	public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('register', 'logout', 'login');
	}
    public function afterFilter(){
        $current_user = AuthComponent::user();	
    }

	// USER REGISTER
	public function register() {
		$this->Session->destroy();
		if ($this->request->is('post')) {
			$this->loadModel('User');
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
				// Data is valid, proceed to save or perform other actions
				if ($this->User->save($this->request->data)) {
					// Data saved successfully
					$this->Session->setFlash('Created account successfully!');
					$this->Session->write('thank_you_shown', true);
					return $this->redirect(array('controller' => 'Main', 'action' => 'thankYouPage'));
				} else {
					// Save failed, handle the error
					$this->Session->setFlash('Error saving data.');
				}
			} else {
				// Data is invalid, validation errors are available
				$validationErrors = $this->User->validationErrors;
				$this->set('validationErrors', $validationErrors);
			}
		}
	}
	
	//USER LOGIN
	public function login() {
		$this->Session->destroy();
		// $this->loadModel('Login');	
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				// $userData['last_login_datetime'] = date('Y-m-d h:i:s');
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login_datetime', date('Y-m-d H:i:s'));
				// $authUser = $this->User->findById($this->Auth->user('id'));
				return $this->redirect($this->Auth->redirectUrl());
			}
				$this->Flash->error(__('Invalid username or password, try again!'));
		}
	}
	
	// LOGOUT USER
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	// USER PROFILE
	public function profile(){
		$userData = $this->User->getProfileData()['User'];
		$this->set('userData', $userData); 
	}

	// UPDATE USER PROFILE
	public function updateProfile(){
		$this->loadModel('Users');
		$errors = null;
		if(isset($this->request->data) && $this->request->data){

			$post_data = $this->request->data;
			$this->set('post_data', $post_data);

			//UPLOAD PHOTO
			$uploadResponse = array();
			if($_FILES['profile_image']['error'] == 0) {
				$uploadResponse = $this->doUploadProfile($_FILES["profile_image"]);
				if ($uploadResponse["sts_code"] == 203) {
					$errors = 1;
				}
			}

			// DO VALIDATION FORM
			$this->User->set($post_data);
			if($this->User->validates() && $errors == NULL){
				if ($uploadResponse != null && $uploadResponse["sts_code"] == 201){
					$post_data["profile_image"] = $uploadResponse["profile_image"];
				}
				// UPDATE USER PROFILE TO DATABASE
				$this->Users->read(NULL, $this->Auth->user('id'));
				$this->Users->set($post_data);
				$this->Users->save();
				$this->Session->setFlash('Updated profile successfully!');
				$authUser = $this->User->findById($this->Auth->user('id'))['User'];
				$this->Auth->login($authUser);
				return $this->redirect(array('controller' => 'Users', 'action' => 'updateProfile'));

			}else{
				$validationErrors = $this->User->validationErrors;
				$this->set('validationErrors', $validationErrors);
			}
		}

	}

	// UPLOAD FUNCTION
	public function doUploadProfile($imageFile) {
		$result = array();
		$allowExtension = array('gif', 'jpeg', 'png', 'jpg');
		$profName = $imageFile['name'];
		$profTmp = $imageFile['tmp_name'];
        $profTxt = substr(strrchr($profName, "."), 1);

		$folderName = 'user_'.AuthComponent::user('id');
		$permissions = 0755;
		$folderPath = WWW_ROOT . 'uploads'. DS . $folderName;

		if (!is_dir($folderPath)) {
			mkdir($folderPath, $permissions, true);
		}

		//CHECK FILE IS EXIST AND RENAME IF ITS EXIST
		$profPathCheck = $folderPath. DS .$profName;
	
		if (file_exists($profPathCheck)) {
			$profName = time().'-'.rand().'-'.$profName;

		}
		$profPath = "uploads". DS .$folderName. DS .$profName;
		//CHECK FILE EXTENSION AND UPLOAD IF VALID
		if(in_array($profTxt, $allowExtension)){
			if (move_uploaded_file($profTmp, WWW_ROOT.$profPath)){
				$result["profile_image"] = $profName;
				$result["sts_code"] = 201;
				$result["msg"] = "Success";
			}
		} else {
			$result["profile_image"] = "";
			$result["sts_code"] = 203;
			$result["msg"] = "File extension is not allowed";
		}
		return $result;
	}

	// UPDATE ACCOUNT EMAIL AND PASSWORD
	public  function accountSettings(){
		$this->loadModel('Users');
		$userData = $this->User->getProfileData()['User'];
		$post_data =$this->request->data;


		// pass data to view
		$this->set('userData', $userData); 
		$this->set('postData',$post_data);

		if (isset($this->request->data) && $this->request->data) {

			// IF EMAIL IS SAME
			if ($post_data["email"] == $this->Auth->user('email')){
				unset($post_data["email"]);
			}
		$this->User->set($post_data);
		if($this->User->validates()){

			if (isset($post_data["password"])){
				$post_data["password"] = AuthComponent::password($post_data["password"]);
			}

			// READ DATA FROM DATABASE
			$this->Users->read(null, $this->Auth->user('id'));
			$this->Users->set($post_data);
			// SAVE UPDATED DATA
			$this->Users->save();

			// AUTH LOGIN
			$authUser = $this->User->findById($this->Auth->user('id'))["User"];
			$this->Auth->login($authUser);
			$this->Session->setFlash('Updated account successfully!');

			return $this->redirect(array('controller' => 'Users', 'action' => 'accountSettings'));
		}else{
			$validationErrors = $this->User->validationErrors;
			$this->set('validationErrors', $validationErrors);
		}
	}

	}

	// ===> FOR AJAX END POINT <===//
	// SEARCH USERS TO MESSAGE - FOR END POINT
	public function getSearchUsers() {
		if (isset($this->request->params['data_string'])) {
			$dataString = $this->request->params['data_string'];
			$getSearchUser = $this->User->searchUsers($dataString);
		}else{
			$getSearchUser = $this->User->getUsersToSendMessage();
		}
		$this->set('jsonData', $getSearchUser);
		$this->viewClass = 'Json';
		$this->set('_serialize', 'jsonData');
    }

	// GET USER - FOR END POINT
	public function getUserData() {
		if (isset($this->request->params['data_id'])) {
			$dataID = $this->request->params['data_id'];
			$getUserData = $this->User->getUserData($dataID);
		}else{
			$getUserData = ['message' => 'Data not found!'];
		}
		$this->set('jsonData', $getUserData);
		$this->viewClass = 'Json';
		$this->set('_serialize', 'jsonData');
    }

	// GET IP ADDRESS 
	public function getIpAddress() {
    // Get the client's IP address
    $ipAddress = $this->request->clientIp();

    // Output the IP address
    echo "Client IP Address: " . $ipAddress;
	}
}


?>