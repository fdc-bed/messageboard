<?php

App::uses('AppController', 'Controller');
App::uses('User', 'AppModel');

class MainController extends AppController{
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'thankYouPage');
    }
    public function afterFilter() {
        parent::afterFilter();
        if($this->action=='thankYouPage'){
            if (!$this->Session->check('thank_you_shown')) {
                return $this->redirect(array('controller' => 'Main', 'action' => 'index'));
            }
        }
    }

    public function index(){
        
    }

    public function thankYouPage(){

    }
}

?>