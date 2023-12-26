<?php

include_once __DIR__. '/../../controller/BookingPaymentController.php';

$id = $_GET['id'];

$decline_controller = new BookingPaymentController();
$decline = $decline_controller->declinePayment($id);

if ($decline) {
    header("Location: bookingPayment.php?declinestatus=declined");
    exit();
} else {
    header("Location: bookingPayment.php?declinestatus=error");
    exit();
}

?>