<?php

include_once  __DIR__. '/../controller/BookingPaymentController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $payment_controller=new BookingPaymentController();
    $result = $payment_controller->deletePayment($id);

    if($result){
        echo "<script>location.href='payment.php'</script>";
    } 
    else {
        echo "Failed to delete booking.";
    }
}

?>
