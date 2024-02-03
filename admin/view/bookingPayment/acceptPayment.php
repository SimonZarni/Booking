<?php

include_once __DIR__. '/../../controller/BookingPaymentController.php';

$id = $_GET['id'];

$accept_controller = new BookingPaymentController();
$accept = $accept_controller->acceptPayment($id);

if ($accept) {
    header("Location: payment.php?acceptstatus=accepted");
    exit();
} else {
    header("Location: payment.php?acceptstatus=error");
    exit();
}

?>