<?php

include_once __DIR__. '/../vendor/database.php';

class BookingPayment {

    public function getBookingPaymentInfo(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT payment.*, booking.id as booking_id, payment_method.payment_type as payment_type
                FROM payment 
                JOIN booking ON payment.booking_id = booking.id
                JOIN payment_method ON payment.payment_type_id = payment_method.id";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO payment(booking_id,customer_name,payment_type_id,account_no,total_price) 
                VALUES(:booking_id,:customer_name,:payment_type,:account_no,:total_price)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':booking_id',$booking);
        $statement->bindParam(':customer_name',$customer_name);
        $statement->bindParam(':payment_type',$payment_type);
        $statement->bindParam(':account_no',$account_no);
        $statement->bindParam(':total_price',$total_price);
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

    public function updateBookingPaymentInfo($id,$booking,$customer_name,$show_time,$payment_type,$account_no,$total_price){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE payment 
                SET booking_id=:booking,customer_name=:customer_name,show_time_id=:show_time,payment_type_id=:payment_type,account_no=:account_no,
                total_price=:total_price WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':booking',$booking);
        $statement->bindParam(':customer_name',$customer_name);
        $statement->bindParam(':show_time',$show_time);
        $statement->bindParam(':payment_type',$payment_type);
        $statement->bindParam(':account_no',$account_no);
        $statement->bindParam(':total_price',$total_price);
        if($statement->execute())
        {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function deleteBookingPaymentInfo($id){
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

    public function acceptBookingPayment($id){
        try {
            $conn = Database::connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);          
            $sql = "UPDATE payment SET status = 'Accepted' WHERE id = :id";          
            $statement = $conn->prepare($sql);
            $statement->bindParam(':id', $id);
            return $statement->execute();
        }   
        catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
        }
    }

    public function declineBookingPayment($id){
        try {
            $conn = Database::connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           
            $sql = "UPDATE payment SET status = 'Declined' WHERE id = :id";         
            $statement = $conn->prepare($sql);
            $statement->bindParam(':id', $id);
            return $statement->execute();
        } 
        catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
        }
    }

    public function emailByPayment($id){
        try {
            $conn = Database::connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "SELECT user.email 
                    FROM user 
                    JOIN payment ON user.id = payment.user_id 
                    WHERE payment.id = :id";
    
            $statement = $conn->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
    
            $email = $statement->fetchColumn();
    
            return $email !== false ? $email : null; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null; 
        }
    }
    
}

?>