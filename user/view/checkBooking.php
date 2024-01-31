<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/BookingController.php';

$booking_controller = new BookingController();
$bookings = $booking_controller->getBookings();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_GET['status']) && $_GET['status'] == true) {
        echo "<span class='text-success'>Movie booked successfully.</span>";
    }
    if (isset($_GET['pay_status']) && $_GET['pay_status'] == true) {
        echo "<span class='text-success'>Booking paid successfully.</span>";
    }
    ?>
    <h3 class="mt-1"><strong>Booking history</strong></h3>

    <div class="col-md-4 mt-3">
        <a class='btn btn-danger p-2' href='payment.php'>Your payments</a>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped" id="mytable">
                <thead>
                    <th>No</th>
                    <th>Movie</th>
                    <th>Date</th>
                    <th>Show Time</th>
                    <th>Theater</th>
                    <th>Seat No</th>
                    <th>No of Tickets</th>
                    <th>Total Price</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($bookings as $booking) {
                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $booking['movie_name'] . "</td>";
                        echo "<td>" . $booking['date'] . "</td>";
                        echo "<td>" . $booking['show_time'] . "</td>";
                        echo "<td>" . $booking['theater'] . "</td>";
                        echo "<td>" . $booking['seat_no'] . "</td>";
                        echo "<td>" . $booking['no_of_tickets'] . "</td>";
                        echo "<td>" . $booking['total_price'] . "</td>";
                        echo "<td>" . $booking['customer_name'] . "</td>";
                        echo "<td>" . $booking['customer_phone'] . "</td>";
                        if ($booking['payment_status'] == 'Paid') {
                            echo "<td class='text-success'>" . $booking['payment_status'] . "</td>";
                        } else {
                            echo "<td class='text-danger'>Unpaid</td>";
                        }
                        echo "<td>";
                        echo "<a class='btn btn-danger mx-2' href='deleteBooking.php?id=" . $booking['id'] . "' onclick='return deleteBooking()'>Delete</a>";
                        if ($booking['payment_status'] == null) {
                            echo "<a class='btn btn-danger mx-2' href='bookingPayment.php?id=" . $booking['id'] . "'>Make Payment</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

<script>
    function deleteBooking() {
        return confirm("Do you want to delete this booking?");
    }
</script>

<?php
include_once  __DIR__ . '/../layouts/footer.php';
?>