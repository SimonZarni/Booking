<?php

include_once __DIR__. '/../vendor/database.php';

class ShowTime {

    // public function getShowTimeInfo(){
    //     $conn = Database::connect();
    //     $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //     $sql = "SELECT * FROM show_time";
    //     $statement = $conn->prepare($sql);
    //     if($statement->execute()){
    //         $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //     }
    //     return $result;
    // }

    public function getShowTimeInfo($movie_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM show_time WHERE movie_id = :movie_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':movie_id',$movie_id);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>