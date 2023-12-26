<?php

include_once __DIR__. '/../model/Authentication.php';

class AuthenticationController extends Authentication {

    public function getUsers(){
        return $this->getUserInfo();
    }

    public function createUser($name,$email,$password){
        return $this->addUser($name,$email,$password);
    }

    public function getUserById($id){
        return $this->getUserList($id);
    }
}

?>