<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/BookingController.php';
include_once  __DIR__. '/../../controller/MovieController.php';
include_once  __DIR__. '/../../controller/ShowTimeController.php';
include_once  __DIR__. '/../../controller/TheaterController.php';

$id = $_GET['id'];

$booking_controller = new BookingController();
$booking = $booking_controller->getBookingById($id);

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

$theater_controller = new TheaterController();
$theaters = $theater_controller->getTheaters();

if (isset($_POST['submit'])) {
    $movie = $_POST['movie'];
    $date = $_POST['date'];
    $show_time = $_POST['show_time'];
    $theater = $_POST['theater'];
    $seat_no = $_POST['seat_no'];
    $no_of_tickets = $_POST['no_of_tickets']; 
    $total_price = $_POST['total_price'];
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $updateStatus = $booking_controller->editBooking($id,$movie,$date,$show_time,$theater,$seat_no,$no_of_tickets,$total_price,$customer_name,$customer_phone);

    if($updateStatus){
        echo '<script>location.href="booking.php?updateStatus=' . $updateStatus . '"</script>';
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
<div class="content">
    <div class="container-fluid">
        <h2><strong>Edit Booking</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <select name="movie" id="" class="form-select">
                        <option value="" selected disabled>Select movie</option>
                        <?php
                        foreach ($movies as $movie) {
                            $selected = ($movie['id'] == $booking['movie_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $movie['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $movie['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Date</label>
                    <input type="date" name="date" value="<?php echo $booking['date']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Show Time</label>
                    <select name="show_time" id="" class="form-select">
                        <option value="" selected disabled>Select showtime</option>
                        <?php
                        foreach ($showtimes as $showtime) {
                            $selected = ($showtime['id'] == $booking['show_time_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $showtime['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $showtime['show_time']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Theater</label>
                    <select name="theater" id="" class="form-select">
                        <option value="" selected disabled>Select theater</option>
                        <?php
                        foreach ($theaters as $theater) {
                            $selected = ($theater['id'] == $booking['theater_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $theater['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $theater['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Seat No</label>
                    <input type="text" name="seat_no" value="<?php echo $booking['seat_no']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">No of Tickets</label>
                    <input type="text" name="no_of_tickets" value="<?php echo $booking['no_of_tickets']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Total Price</label>
                    <input type="text" name="total_price" value="<?php echo $booking['total_price']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" value="<?php echo $booking['customer_name']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Customer Phone</label>
                    <input type="text" name="customer_phone" value="<?php echo $booking['customer_phone']; ?>" class="form-control">
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit" name="submit">Update</button>
                </div>
            </form>
    </div>
</div>

<script src="../../public/js/app.js"></script>

</body>

</html>

<?php
include_once __DIR__. '/../../layouts/admin_footer.php';
?>