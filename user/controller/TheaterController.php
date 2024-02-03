<?php

include_once __DIR__. '/../model/Theater.php';

class TheaterController extends Theater {

    public function getTheaters($movie_id){
        return $this->getTheaterInfo($movie_id);
    }
}

?>