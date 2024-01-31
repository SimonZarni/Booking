<?php

include_once __DIR__. '/../model/Booking.php';

class BookingController extends Booking {

    public function getBookings(){
        return $this->getBookingInfo();
    }

    public function createBooking($movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$user){
        return $this->addBooking($movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$user);
    }

    public function deleteBooking($id){
        return $this->deleteBookingInfo($id);
    }

    public function makePayment($id){
        return $this->makeBookingPayment($id);
    }
} 

?>