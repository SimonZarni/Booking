<?php

include_once __DIR__. '/../vendor/database.php';

class Movie {

    public function getMovieInfo(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT movie.*, category.name as category_name FROM movie JOIN category ON movie.category_id = category.id";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>