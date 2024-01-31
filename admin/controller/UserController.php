<?php

include_once __DIR__. '/../model/User.php';

class UserController extends User {

    public function getUsers(){
        return $this->getUserInfo();
    }

    public function userById($id){
        return $this->getUserById($id);
    }

    public function deleteUser($id){
        return $this->deleteUserInfo($id);
    }
}

?>