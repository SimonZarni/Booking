<?php

include_once __DIR__. '/../vendor/database.php';

class ShowTime {

    public function getShowTimeInfo(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM show_time";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addShowTime($showtime){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO show_time(show_time) VALUES(:show_time)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':show_time',$showtime);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function getShowTimeList($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM show_time WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateShowTimeInfo($id,$name,$movie){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE show_time set show_time=:name, movie_id = :movie WHERE id=:id";
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

    public function deleteShowTimeInfo($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM show_time WHERE id=:id";
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

    public function movieShowtime($movie,$showtime){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO movie_showtime(movie_id,showtime_id) VALUES(:movie,:show_time)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':movie',$movie);
        $statement->bindParam(':show_time',$showtime);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function getMovieShowtime(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT movie_showtime.*, 
                movie.name AS movie, 
                show_time.show_time AS showtime
                FROM movie_showtime 
                JOIN movie ON movie_showtime.movie_id = movie.id 
                JOIN show_time ON movie_showtime.showtime_id = show_time.id;";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function deleteMovieShowtime($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM movie_showtime WHERE id=:id";
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