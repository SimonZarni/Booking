<?php

include_once __DIR__. '/../vendor/database.php';

class ShowTime {

    public function getShowTimeInfo($movie_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM show_time WHERE movie_id = :movie_id";
        $sql = "SELECT s.* FROM show_time s 
                INNER JOIN movie_showtime ms ON s.id = ms.showtime_id 
                WHERE ms.movie_id = :movie_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':movie_id',$movie_id);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>