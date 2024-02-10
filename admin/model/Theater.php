<?php

include_once __DIR__. '/../vendor/database.php';

class Theater {
    
    public function getTheaterInfo(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM theater";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addTheater($name,$movie){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO theater(name,movie_id) VALUES(:name,:movie)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':movie',$movie);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function getTheaterList($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM theater WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateTheaterInfo($id,$name,$movie){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE theater set name=:name, movie_id = :movie WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':movie',$movie);
        if($statement->execute())
        {
            return true;        
        }
        else {
            return false;
        }
    }

    public function deleteTheaterInfo($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM theater WHERE id=:id";
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

    public function movieTheater($movie,$theater){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO movie_theater(movie_id,theater_id) VALUES(:movie,:theater)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':movie',$movie);
        $statement->bindParam(':theater',$theater);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function getMovieTheater(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT movie_theater.*, 
                movie.name AS movie, 
                theater.name AS theater
                FROM movie_theater 
                JOIN movie ON movie_theater.movie_id = movie.id 
                JOIN theater ON movie_theater.theater_id = theater.id;";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function deleteMovieTheater($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM movie_theater WHERE id=:id";
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