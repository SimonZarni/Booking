<?php

include_once  __DIR__. '/../controller/BookingController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $booking_controller=new BookingController();
    $result = $booking_controller->deleteBooking($id);

    if($result){
        echo "<script>location.href='checkBooking.php?'</script>";
    } 
    else {
        echo "Failed to delete booking.";
    }
}

?>
