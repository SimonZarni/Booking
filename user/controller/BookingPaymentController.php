<?php

include_once __DIR__. '/../model/BookingPayment.php';

class BookingPaymentController extends BookingPayment {

    public function getBookingPayments($user_id){
        return $this->getBookingPaymentInfo($user_id);
    }

    public function getEachBookingPayment($id){
        return $this->getBookingPayment($id);
    }

    public function createBookingPayment($booking,$user_name,$payment_type,$account_no,$total_price,$user_id,$payment_date){
        return $this->addBookingPayment($booking,$user_name,$payment_type,$account_no,$total_price,$user_id,$payment_date);
    }

    public function getBookingPaymentById($id){
        return $this->getBookingPaymentList($id);
    }

    public function deletePayment($id){
        return $this->deletePaymentInfo($id);
    }
} 

?>