<?php

include_once __DIR__. '/../model/BookingPayment.php';

class BookingPaymentController extends BookingPayment {

    public function getBookingPayments($user_id){
        return $this->getBookingPaymentInfo($user_id);
    }

    public function createBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price,$user_id){
        return $this->addBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price,$user_id);
    }

    public function getBookingPaymentById($id){
        return $this->getBookingPaymentList($id);
    }
} 

?>