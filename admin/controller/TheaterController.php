<?php

include_once __DIR__. '/../model/Theater.php';

class TheaterController extends Theater {

    public function getTheaters(){
        return $this->getTheaterInfo();
    }

    public function createTheater($name){
        return $this->addTheater($name);
    }

    public function getTheaterById($id){
        return $this->getTheaterList($id);
    }

    public function editTheater($id,$name){
        return $this->updateTheaterInfo($id,$name);
    }

    public function deleteTheater($id){
        return $this->deleteTheaterInfo($id);
    }
}

?>