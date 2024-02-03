<?php

include_once __DIR__. '/../model/ShowTime.php';

class ShowTimeController extends ShowTime{

    public function getShowTimes(){
        return $this->getShowTimeInfo();
    }

    public function createShowTime($showtime,$movie){
        return $this->addShowTime($showtime,$movie);
    }

    public function getShowTimeById($id){
        return $this->getShowTimeList($id);
    }

    public function editShowTime($id,$name,$movie){
        return $this->updateShowTimeInfo($id,$name,$movie);
    }

    public function deleteShowTime($id){
        return $this->deleteShowTimeInfo($id);
    }
}

?>