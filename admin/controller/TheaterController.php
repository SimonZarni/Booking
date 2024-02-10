<?php

include_once __DIR__. '/../model/Theater.php';

class TheaterController extends Theater {

    public function getTheaters(){
        return $this->getTheaterInfo();
    }

    public function createTheater($name,$movie){
        return $this->addTheater($name,$movie);
    }

    public function getTheaterById($id){
        return $this->getTheaterList($id);
    }

    public function editTheater($id,$name,$movie){
        return $this->updateTheaterInfo($id,$name,$movie);
    }

    public function deleteTheater($id){
        return $this->deleteTheaterInfo($id);
    }

    public function joinMovieTheater($movie,$theater){
        return $this->movieTheater($movie,$theater);
    }

    public function getMoviesTheaters(){
        return $this->getMovieTheater();
    }

    public function deleteData($id){
        return $this->deleteMovieTheater($id);
    }
}

?>