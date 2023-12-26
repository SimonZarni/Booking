<?php

include_once __DIR__. '/../model/BookingPayment.php';

class BookingPaymentController extends BookingPayment {

    public function getBookingPayments(){
        return $this->getBookingPaymentInfo();
    }

    public function createBookingPayment($booking,$customer_name,$show_time,$payment_type,$account_no,$total_price){
        return $this->addBookingPayment($booking,$customer_name,$show_time,$payment_type,$account_no,$total_price);
    }

    public function getBookingPaymentById($id){
        return $this->getBookingPaymentList($id);
    }

    public function editBookingPayment($id,$booking,$customer_name,$show_time,$payment_type,$account_no,$total_price){
        return $this->updateBookingPaymentInfo($id,$booking,$customer_name,$show_time,$payment_type,$account_no,$total_price);
    }

    public function deleteBookingPayment($id){
        return $this->deleteBookingPaymentInfo($id);
    }

    public function acceptPayment($id){
        return $this->acceptBookingPayment($id);
    }

    public function declinePayment($id){
        return $this->declineBookingPayment($id);
    }
} 

?>