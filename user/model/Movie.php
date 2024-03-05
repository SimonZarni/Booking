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

    public function movieByCategory($category_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT movie.*, category.name as category_name 
                FROM movie 
                JOIN category ON movie.category_id = category.id
                WHERE movie.category_id = :category_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':category_id', $category_id);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function searchMovie($keyword) {
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT movie.*, category.name as category_name
                FROM movie
                JOIN category ON movie.category_id = category.id
                WHERE movie.name LIKE :keyword
                OR category.name LIKE :keyword";
        $statement = $conn->prepare($sql);
        $searchKeyword = "%$keyword%";
        $statement->bindParam(':keyword', $searchKeyword);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }  
}

?>