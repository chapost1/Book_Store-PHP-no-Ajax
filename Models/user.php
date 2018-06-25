<?php

class user {

    private $user_id;
    private $username;
    private $password;
    private $email;
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }
    function getUser_id() {
        return $this->user_id;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    
          
    function __construct($user_id, $username, $password, $email) {
        if (!$user_id == "" || !$user_id == NULL) {
            $this->user_id = $user_id;
        }
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
}

