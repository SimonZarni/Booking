<?php

include_once __DIR__. '/../model/Booking.php';

class BookingController extends Booking {

    public function getBookings(){
        return $this->getBookingInfo();
    }

    public function createBooking($movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$user){
        return $this->addBooking($movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$user);
    }

    public function getBookingById($id){
        return $this->getBookingList($id);
    }

    public function editBooking($id,$movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$customer_name,$customer_phone){
        return $this->updateBookingInfo($id,$movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$customer_name,$customer_phone);
    }

    public function deleteBooking($id){
        return $this->deleteBookingInfo($id);
    }
} 

?>