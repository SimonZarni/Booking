<?php

include_once __DIR__. '/../model/BookingPayment.php';

class BookingPaymentController extends BookingPayment {

    public function createBookingPayment($booking,$customer_name,$show_time,$payment_type,$account_no,$total_price){
        return $this->addBookingPayment($booking,$customer_name,$show_time,$payment_type,$account_no,$total_price);
    }

    public function getBookingPaymentById($id){
        return $this->getBookingPaymentList($id);
    }
} 

?>