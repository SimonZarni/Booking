<?php

include_once __DIR__. '/../vendor/database.php';

class Theater {

    public function getTheaterInfo($movie_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT t.* FROM theater t 
                INNER JOIN movie_theater mt ON t.id = mt.theater_id 
                WHERE mt.movie_id = :movie_id";
        // $sql = "SELECT * FROM theater WHERE movie_id = :movie_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>