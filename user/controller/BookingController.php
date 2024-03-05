<?php

include_once __DIR__. '/../model/Booking.php';

class BookingController extends Booking {

    public function getBookings($user_id){
        return $this->getBookingInfo($user_id);
    }

    public function createBooking($movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$user_name,$user_id){
        return $this->addBooking($movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$user_name,$user_id);
    }

    public function deleteBooking($id){
        return $this->deleteBookingInfo($id);
    }

    public function makePayment($id){
        return $this->makeBookingPayment($id);
    }
} 

?>