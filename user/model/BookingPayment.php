<?php

include_once __DIR__. '/../vendor/database.php';

class BookingPayment {

    public function getBookingPaymentInfo($user_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT payment.*, booking.id as booking_id, payment_method.payment_type as payment_type
                FROM payment 
                JOIN booking ON payment.booking_id = booking.id
                JOIN payment_method ON payment.payment_type_id = payment_method.id
                WHERE booking.user_id = :user_id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':user_id', $user_id);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getBookingPayment($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT payment.*, booking.id as booking_id, payment_method.payment_type as payment_type
                FROM payment 
                JOIN booking ON payment.booking_id = booking.id
                JOIN payment_method ON payment.payment_type_id = payment_method.id
                WHERE payment.id = :id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addBookingPayment($booking,$user_name,$payment_type,$account_no,$total_price,$user_id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO payment(booking_id,customer_name,payment_type_id,account_no,total_price,user_id) 
                VALUES(:booking_id,:customer_name,:payment_type,:account_no,:total_price,:user_id)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':booking_id',$booking);
        $statement->bindParam(':customer_name',$user_name);
        $statement->bindParam(':payment_type',$payment_type);
        $statement->bindParam(':account_no',$account_no);
        $statement->bindParam(':total_price',$total_price);
        $statement->bindParam(':user_id',$user_id);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function getBookingPaymentList($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM payment WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function deletePaymentInfo($id){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM payment WHERE id=:id";
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