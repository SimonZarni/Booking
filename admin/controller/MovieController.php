<?php

include_once __DIR__. '/../model/Movie.php';

class MovieController extends Movie {

    public function getMovies(){
        return $this->getMovieInfo();
    }

    public function createMovie($name,$image,$category,$duration,$release_date){
        return $this->addMovie($name,$image,$category,$duration,$release_date);
    }

    public function getMovieById($id){
        return $this->getMovieList($id);
    }

    public function editMovie($id,$name,$image,$category,$duration,$release_date){
        return $this->updateMovieInfo($id,$name,$image,$category,$duration,$release_date);
    }

    public function deleteMovie($id){
        return $this->deleteMovieInfo($id);
    }
} 

?>