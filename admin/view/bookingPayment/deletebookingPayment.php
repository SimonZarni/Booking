<?php

include_once  __DIR__. '/../../controller/BookingPaymentController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $booking_payment_controller=new BookingPaymentController();
    $result = $booking_payment_controller->deleteBookingPayment($id);

    if($result){
        echo "<script>location.href='payment.php'</script>";
    } 
    else {
        echo "Failed to delete booking payment.";
    }
}

?>