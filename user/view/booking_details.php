<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/BookingController.php';

$id = $_GET['id'];
$booking_controller = new BookingController();
$booking = $booking_controller->getBookingById($id);

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
            <p><strong>Booking ID:</strong> <?php echo $booking['id']; ?></p>
            <p><strong>Movie:</strong> <?php echo $booking['movie_name'] ?></p>
            <p><strong>Date:</strong> <?php echo $booking['date']; ?></p>
            <p><strong>Showtime:</strong> <?php echo $booking['show_time']; ?></p>
            <p><strong>Theater:</strong> <?php echo $booking['theater']; ?></p>
            <p><strong>Seat No:</strong> <?php echo $booking['seat_no']; ?></p>
            <p><strong>No of tickets:</strong> <?php echo $booking['no_of_tickets']; ?></p>
            <p><strong>Total Price:</strong> <?php echo $booking['total_price']; ?></p>
            <p><strong>Customer Name:</strong> <?php echo $booking['customer_name']; ?></p>
            <p><strong>Payment Status:</strong> <?php if($booking['payment_status'] == null) echo "Unpaid" ?></p>
            <p><strong>User ID:</strong> <?php echo $booking['user_id']; ?></p>
        </div>
    </div>
</body>

</html>

<?php
include_once  __DIR__ . '/../layouts/footer.php';
?>