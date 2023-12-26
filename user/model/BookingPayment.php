<?php

include_once __DIR__. '/../vendor/database.php';

class BookingPayment {

    public function addBookingPayment($booking,$customer_name,$show_time,$payment_type,$account_no,$total_price){
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO booking_payment(booking_id,customer_name,show_time_id,payment_type_id,account_no,total_price) 
                VALUES(:booking_id,:customer_name,:show_time,:payment_type,:account_no,:total_price)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':booking_id',$booking);
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