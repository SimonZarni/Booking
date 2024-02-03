<?php

include_once __DIR__. '/../../controller/BookingPaymentController.php';

$id = $_GET['id'];

$decline_controller = new BookingPaymentController();
$decline = $decline_controller->declinePayment($id);

if ($decline) {
    header("Location: payment.php?declinestatus=declined");
    exit();
} else {
    header("Location: payment.php?declinestatus=error");
    exit();
}

?>