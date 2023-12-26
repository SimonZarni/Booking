<?php

include_once __DIR__. '/../model/ShowTime.php';

class ShowTimeController extends ShowTime{

    public function getShowTimes(){
        return $this->getShowTimeInfo();
    }

    public function createShowTime($showtime){
        return $this->addShowTime($showtime);
    }

    public function getShowTimeById($id){
        return $this->getShowTimeList($id);
    }

    public function editShowTime($id,$name){
        return $this->updateShowTimeInfo($id,$name);
    }

    public function deleteShowTime($id){
        return $this->deleteShowTimeInfo($id);
    }
}

?>