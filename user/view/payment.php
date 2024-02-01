<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/BookingPaymentController.php';

$booking_payment_controller = new BookingPaymentController();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $booking_payments = $booking_payment_controller->getBookingPayments($user_id);
} else {
    $booking_payments = [];
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
    <h3 class="mt-1"><strong>Payment history</strong></h3>
    <div class="col-md-4 mt-3">
        <a class='btn btn-danger p-2' href='checkBooking.php'>Your bookings</a>
    </div>

    <?php if (!empty($booking_payments)) {
    ?>
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-striped" id="mytable">
                    <thead>
                        <th>No</th>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Payment Type</th>
                        <th>Account No</th>
                        <th>Total Price</th>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($booking_payments as $booking_payment) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $booking_payment['booking_id'] . "</td>";
                            echo "<td>" . $booking_payment['customer_name'] . "</td>";
                            echo "<td>" . $booking_payment['payment_type'] . "</td>";
                            echo "<td>" . $booking_payment['account_no'] . "</td>";
                            echo "<td>" . $booking_payment['total_price'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    } else {
    ?>
        <h4 class='text-danger mt-2'>You don't have any payment history.</h4>
    <?php
    }
    ?>

</body>

</html>

<?php
include_once  __DIR__ . '/../layouts/footer.php';
?>