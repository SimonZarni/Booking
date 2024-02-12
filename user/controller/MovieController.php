<?php

include_once __DIR__. '/../model/Movie.php';

class MovieController extends Movie {

    public function getMovies(){
        return $this->getMovieInfo();
    }

    public function getMovieByCategory($category_id){
        return $this->movieByCategory($category_id);
    }

    public function searchMovies($keyword){
        return $this->searchMovie($keyword);
    }
} 

?>