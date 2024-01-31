<?php

include_once __DIR__. '/../vendor/database.php';

class BookingPayment {

    public function getBookingPaymentInfo(){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT booking_payment.*, booking.id as booking_id, payment.payment_type as payment_type
                FROM booking_payment 
                JOIN booking ON booking_payment.booking_id = booking.id
                JOIN payment ON booking_payment.payment_type_id = payment.id";
        $statement = $conn->prepare($sql);
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO booking_payment(booking_id,customer_name,payment_type_id,account_no,total_price) 
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
        $sql = "SELECT * FROM booking_payment WHERE id=:id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute()){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>