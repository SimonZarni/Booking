<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__ . '/../../controller/BookingController.php';
include_once  __DIR__ . '/../../controller/MovieController.php';
include_once  __DIR__ . '/../../controller/ShowTimeController.php';
include_once  __DIR__ . '/../../controller/TheaterController.php';
include_once  __DIR__ . '/../../controller/UserController.php';

$booking_controller = new BookingController();

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

$theater_controller = new TheaterController();
$theaters = $theater_controller->getTheaters();

$user_controller = new UserController();
$users = $user_controller->getUsers();

if (isset($_POST['submit'])) {
    $movie = $_POST['movie'];
    $date = $_POST['date'];
    $showtime = $_POST['show_time'];
    $theater = $_POST['theater'];
    $seat_no = $_POST['seats'];
    $total_price = $_POST['total_price'];
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $status = $booking_controller->createBooking($movie, $date, $showtime, $theater, $seat_no, $total_price, $user_name, $user_id);

    if ($status) {
        echo '<script>location.href="booking.php?status=' . $status . '"</script>';
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
            <h2><strong>Add New Booking</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">User Name</label>
                    <select name="user_name" id="" class="form-select">
                        <option value="" selected disabled>Select User Name</option>
                        <?php
                        foreach ($users as $user) {
                        ?>
                            <option value="<?php echo $user['name']; ?>">
                                <?php echo $user['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">User ID</label>
                    <select name="user_id" id="" class="form-select">
                        <option value="" selected disabled>Select User ID</option>
                        <?php
                        foreach ($users as $user) {
                        ?>
                            <option value="<?php echo $user['id']; ?>" <?php if ((isset($_POST['user']) && $_POST['user']) == $user['id']) echo 'selected'; ?>>
                                <?php echo $user['id']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <select name="movie" id="" class="form-select">
                        <option value="" selected disabled>Select movie</option>
                        <?php
                        foreach ($movies as $movie) {
                        ?>
                            <option value="<?php echo $movie['id']; ?>" <?php if ((isset($_POST['movie']) && $_POST['movie']) == $movie['id']) echo 'selected'; ?>>
                                <?php echo $movie['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Date</label>
                    <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Theater</label>
                    <select name="theater" id="" class="form-select">
                        <option value="" selected disabled>Select theater</option>
                        <?php
                        foreach ($theaters as $theater) {
                        ?>
                            <option value="<?php echo $theater['id']; ?>" <?php if ((isset($_POST['theater']) && $_POST['theater']) == $theater['id']) echo 'selected'; ?>>
                                <?php echo $theater['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Show Time</label>
                    <select name="show_time" id="" class="form-select">
                        <option value="" selected disabled>Select showtime</option>
                        <?php
                        foreach ($showtimes as $showtime) {
                        ?>
                            <option value="<?php echo $showtime['id']; ?>" <?php if ((isset($_POST['show_time']) && $_POST['show_time']) == $showtime['id']) echo 'selected'; ?>>
                                <?php echo $showtime['show_time']; ?>
                            </option>
                        <?php
                        }
                        ?>
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
                    <button class="btn btn-success" type="submit" name="submit">Add</button>
                </div>
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

    <script src="../../public/js/app.js"></script>

</body>

</html>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>