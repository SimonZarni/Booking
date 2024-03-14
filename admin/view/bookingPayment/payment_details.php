<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/BookingPaymentController.php';

$id = $_GET['id'];

$booking_payment_controller = new BookingPaymentController();
$booking_payments = $booking_payment_controller->getBookingPayments();

foreach ($booking_payments as $booking_payment) {
    if ($id == $booking_payment['id']) {
        break;
    }
}

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
            <p><strong>Payment Date:</strong> <?php echo $booking_payment['payment_date']; ?></p>
            <p><strong>Status:</strong>
                <?php if ($booking_payment['status'] == 'Accepted') {
                    echo "Accepted";
                } elseif ($booking_payment['status'] == 'Declined') {
                    echo "Declined";
                } else {
                    echo "Pending";
                }
                ?>
            </p>
        </div>
    </div>
</body>

</html>

<?php
include_once  __DIR__ . '/../../layouts/admin_footer.php';
?>