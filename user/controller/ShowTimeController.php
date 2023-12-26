<?php

include_once __DIR__. '/../model/ShowTime.php';

class ShowTimeController extends ShowTime{

    public function getShowTimes(){
        return $this->getShowTimeInfo();
    }
}

?>