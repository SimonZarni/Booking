<?php

include_once __DIR__. '/../model/Theater.php';

class TheaterController extends Theater {

    public function getTheaters(){
        return $this->getTheaterInfo();
    }
}

?>