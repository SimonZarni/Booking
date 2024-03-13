<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once  __DIR__ . '/../controller/BookingController.php';
include_once  __DIR__ . '/../controller/MovieController.php';
include_once  __DIR__ . '/../controller/ShowTimeController.php';
include_once  __DIR__ . '/../controller/TheaterController.php';

$booking_controller = new BookingController();

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

$showtime_controller = new ShowTimeController();

$theater_controller = new TheaterController();

if (isset($_POST['submit'])) {
    if (!isset($_SESSION['user_id'])) {
        $error = "You need to login to book a movie.";
    } else {
        $movie = $_POST['movie'];
        $date = $_POST['date'];
        $showtime = $_POST['show_time'];
        $theater = $_POST['theater'];
        $seat_no = $_POST['seats'];
        $total_price = $_POST['total_price'];
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];
        $status = $booking_controller->createBooking($movie, $date, $showtime, $theater, $seat_no, $total_price, $user_name, $user_id);

        if ($status) {
            echo '<script>location.href="checkBooking.php?status=' . $status . '"</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .seat {
            width: 40px;
            height: 40px;
            background-color: #ff4444;
            border: 1px solid #aaa;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
        }

        .selected {
            background-color: #007bff;
            color: #fff;
        }

        .seat:hover {
            background-color: #ff6666;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <a class="btn btn-danger mt-1" href="checkBooking.php">Check your Booking</a>
            <h2><strong>Book Your Seats Now!</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <select name="movie" id="" class="form-select">
                        <option value="" selected disabled>Select movie</option>
                        <?php
                        $selectedMovieId = isset($_POST['movie']) ? $_POST['movie'] : (isset($_GET['id']) ? $_GET['id'] : null);

                        foreach ($movies as $movie) {
                            if ($selectedMovieId !== null && $selectedMovieId == $movie['id']) {
                        ?>
                                <option value="<?php echo $movie['id']; ?>" selected>
                                    <?php echo $movie['name']; ?>
                                </option>
                        <?php
                                break;
                            }
                        }
                        ?>
                    </select>
                </div>

                <?php
                $showtimes = $showtime_controller->getShowTimes($selectedMovieId);
                $theaters = $theater_controller->getTheaters($selectedMovieId);
                ?>

                <div class="my-3">
                    <label for="" class="form-label">Date</label>
                    <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Theater</label>
                    <select name="theater" id="" class="form-select">
                        <option value="" selected disabled>Select theater</option>
                        <?php foreach ($theaters as $theater) { ?>
                            <option value="<?php echo $theater['id']; ?>"><?php echo $theater['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Showtime</label>
                    <select name="show_time" id="" class="form-select">
                        <option value="" selected disabled>Select showtime</option>
                        <?php foreach ($showtimes as $showtime) { ?>
                            <option value="<?php echo $showtime['id']; ?>"><?php echo $showtime['show_time']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Seat Selection</label>
                    <table id="seatSelection" class="table table-bordered">
                    </table>
                    <input type="hidden" name="seats" id="selectedSeats" value="">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Total Price</label>
                    <input type="text" name="total_price" id="total_price" value="<?php if (isset($_POST['total_price'])) echo $_POST['total_price']; ?>" class="form-control">
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit" name="submit">Book</button>
                </div>

                <?php
                if (isset($error)) {
                    echo "<span class='text-danger'>$error</span>";
                }
                ?>

            </form>
        </div>
    </div>

    <script>
        var rows = 5;
        var seatsPerRow = 10;
        var basePrice = 6000;
        var priceIncrement = 3000;

        function generateSeatingChart() {
            var seatSelection = document.getElementById('seatSelection');
            var seatHTML = '';

            for (var i = 1; i <= rows; i++) {
                var rowName = String.fromCharCode(65 + i - 1);
                seatHTML += '<tr>';
                for (var j = 1; j <= seatsPerRow; j++) {
                    seatHTML += '<td><div class="seat" id="' + rowName + '-' + j + '" onclick="toggleSeat(\'' + rowName + '\',' + j + ')">' + rowName + '-' + j + '</div></td>';
                }
                seatHTML += '</tr>';
            }
            seatSelection.innerHTML = seatHTML;
        }

        function toggleSeat(row, seat) {
            var seatElement = document.getElementById(row + '-' + seat);
            seatElement.classList.toggle('selected');
            updateSelectedSeats();
            updateTotalPrice();
        }

        function updateSelectedSeats() {
            var selectedSeats = [];
            var seatElements = document.getElementsByClassName('selected');
            for (var i = 0; i < seatElements.length; i++) {
                selectedSeats.push(seatElements[i].innerText);
            }
            document.getElementById('selectedSeats').value = selectedSeats.join(',');
        }

        function updateTotalPrice() {
            var totalPrice = 0;
            var selectedSeats = document.getElementsByClassName('selected');
            for (var i = 0; i < selectedSeats.length; i++) {
                var seatId = selectedSeats[i].id.split('-');
                var row = seatId[0].charCodeAt(0) - 64; 
                totalPrice += basePrice + (row - 1) * priceIncrement;
            }
            document.getElementById('total_price').value = totalPrice.toFixed(2);
        }

        generateSeatingChart();
    </script>

</body>

</html>