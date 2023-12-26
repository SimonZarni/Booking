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
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
	<link href="../public/css/font-awesome.min.css" rel="stylesheet">
	<link href="../public/css/global.css" rel="stylesheet">
	<link href="../public/css/index.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<script src="../public/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
    if(isset($_GET['status']) && $_GET['status']==true)
    {
        echo "<span class='text-success'>Movie booked successfully.</span>";
    }
    ?>
    
<h2 class="mt-1"><strong>Your Booking</strong></h2>
    <div class="col-md-4 mt-3">
        <a class='btn btn-danger p-2' href='booking.php?'>Add New Booking</a>
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
                <th>Customer Name</th>
                <th>Customer Phone</th>
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
                    echo "<td>";
                    echo "<a class='btn btn-danger mx-2' href='deleteBooking.php?id=".$booking['id']."' onclick='return deleteBooking()'>Delete</a>";
                    echo "<a class='btn btn-danger mx-2' href='bookingPayment.php?id=".$booking['id']."'>Make Payment</a>";
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
    function deleteBooking(){
        return confirm("Do you want to delete this booking?");
    }
</script>

<?php
include_once  __DIR__. '/../layouts/footer.php';
?>