<?php

include_once __DIR__. '/../model/BookingPayment.php';

class BookingPaymentController extends BookingPayment {

    public function getBookingPayments(){
        return $this->getBookingPaymentInfo();
    }

    public function createBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price){
        return $this->addBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price);
    }

    public function getBookingPaymentById($id){
        return $this->getBookingPaymentList($id);
    }
} 

?>