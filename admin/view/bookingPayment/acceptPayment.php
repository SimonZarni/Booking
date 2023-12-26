<?php

include_once __DIR__. '/../../controller/BookingPaymentController.php';

$id = $_GET['id'];

$accept_controller = new BookingPaymentController();
$accept = $accept_controller->acceptPayment($id);

if ($accept) {
    header("Location: bookingPayment.php?acceptstatus=accepted");
    exit();
} else {
    header("Location: bookingPayment.php?acceptstatus=error");
    exit();
}

?>