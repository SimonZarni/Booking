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

    public function editShowTime($id,$name,$movie){
        return $this->updateShowTimeInfo($id,$name,$movie);
    }

    public function deleteShowTime($id){
        return $this->deleteShowTimeInfo($id);
    }

    public function joinMovieShowtime($movie,$showtime){
        return $this->movieShowtime($movie,$showtime);
    }

    public function getMoviesShowtimes(){
        return $this->getMovieShowtime();
    }

    public function deleteData($id){
        return $this->deleteMovieShowtime($id);
    }
}

?>