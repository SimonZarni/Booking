<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/BookingPaymentController.php';

$id = $_GET['id'];
$bookingPayment_controller = new BookingPaymentController();
$booking_payment = $bookingPayment_controller->getEachBookingPayment($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <p><strong>Payment ID:</strong> <?php echo $booking_payment['id']; ?></p>
            <p><strong>Booking ID:</strong> <?php echo $booking_payment['booking_id'] ?></p>
            <p><strong>Customer Name:</strong> <?php echo $booking_payment['customer_name']; ?></p>
            <p><strong>Payment Type:</strong> <?php echo $booking_payment['payment_type']; ?></p>
            <p><strong>Account No:</strong> <?php echo $booking_payment['account_no']; ?></p>
            <p><strong>Total Price:</strong> <?php echo $booking_payment['total_price']; ?></p>
            <p><strong>Status:</strong> <?php echo $booking_payment['status']; ?></p>
            <p><strong>User ID:</strong> <?php echo $booking_payment['user_id']; ?></p>
        </div>
    </div>
</body>

</html>

<?php
include_once  __DIR__ . '/../layouts/footer.php';
?>