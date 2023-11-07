<?php

class Login extends AppModel {
public $name = 'Login';
public $validate = array(
    'email' => array(
        'required' => array(
            'rule' => 'notBlank',
            'message' => 'Email is required'
        ),
        'validEmail' => array(
            'rule' => 'email',
            'message' => 'Please enter a valid email address'
        )
    ),
    'password' => array(
        'required' => array(
            'rule' => 'notBlank',
            'message' => 'Password is required'
        )
    )
);

}

?>