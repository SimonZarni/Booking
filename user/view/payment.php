<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/BookingPaymentController.php';

$booking_payment_controller = new BookingPaymentController();
$booking_payments = $booking_payment_controller->getBookingPayments();

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
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Show Time</th>
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
                        echo "<td>" . $booking_payment['customer_name'] . "</td>";
                        echo "<td>" . $booking_payment['show_time'] . "</td>";
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

</body>

</html>

<?php
include_once  __DIR__ . '/../layouts/footer.php';
?>