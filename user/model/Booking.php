<?php

include_once __DIR__. '/../vendor/database.php';

class Booking {

    public function getBookingInfo($user_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT booking.*, movie.name as movie_name, show_time.show_time as show_time, theater.name as theater FROM booking 
                JOIN movie ON booking.movie_id = movie.id 
                JOIN show_time ON booking.show_time_id = show_time.id
                JOIN theater ON booking.theater_id = theater.id
                WHERE user_id = :user_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':user_id', $user_id);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getBooking($id){
        $conn = Database::connect();
        $sql = "SELECT booking.*, movie.name as movie_name, show_time.show_time as show_time, theater.name as theater FROM booking 
                JOIN movie ON booking.movie_id = movie.id 
                JOIN show_time ON booking.show_time_id = show_time.id
                JOIN theater ON booking.theater_id = theater.id
                WHERE booking.id = :id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addBooking($movie,$date,$show_time,$theater,$seat_no,$total_price,$user_name,$user_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO booking(movie_id,date,show_time_id,theater_id,seat_no,total_price,customer_name,user_id) 
                VALUES(:movie,:date,:show_time,:theater,:seat_no,:total_price,:customer_name,:user_id)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':movie',$movie);
        $statement->bindParam(':date',$date);
        $statement->bindParam(':show_time',$show_time);
        $statement->bindParam(':theater',$theater);
        $statement->bindParam(':seat_no',$seat_no);
        $statement->bindParam(':total_price',$total_price);
        $statement->bindParam(':customer_name',$user_name);
        $statement->bindParam(':user_id',$user_id);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function deleteBookingInfo($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM booking WHERE id=:id";
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

    public function makeBookingPayment($id){
        try {
            $conn = Database::connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);          
            $sql = "UPDATE booking SET payment_status = 'Paid' WHERE id = :id";          
            $statement = $conn->prepare($sql);
            $statement->bindParam(':id', $id);
            return $statement->execute();
        }   
        catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
        }
    }
}

?>