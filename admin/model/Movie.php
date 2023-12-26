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

    public function addMovie($name,$image,$category,$duration,$release_date){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO movie(name,image,category_id,duration,release_date) VALUES(:name,:image,:category,:duration,:release_date)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':image',$image);
        $statement->bindParam(':category',$category);
        $statement->bindParam(':duration',$duration);
        $statement->bindParam(':release_date',$release_date);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function getMovieList($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM movie WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateMovieInfo($id,$name,$image,$category,$duration,$release_date){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE movie 
                SET name=:name,image=:image,duration=:duration,release_date=:release_date,category_id=:category
                WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':image',$image);
        $statement->bindParam(':category',$category);
        $statement->bindParam(':duration',$duration);
        $statement->bindParam(':release_date',$release_date);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function deleteMovieInfo($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM movie WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        try{
            $statement->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

?>