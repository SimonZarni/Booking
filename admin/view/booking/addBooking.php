<?php

// include_once __DIR__ . '/../../layouts/admin_navbar.php';
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

if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
}

if (isset($_POST['submit'])) {
    $movie = $_POST['movie'];
    $date = $_POST['date'];
    $showtime = $_POST['show_time'];
    $theater = $_POST['theater'];
    $seat_no = $_POST['seat_no'];
    $no_of_tickets = $_POST['no_of_tickets'];
    $total_price = $_POST['total_price'];
    $user = $_POST['user'];
    $status = $booking_controller->createBooking($movie, $date, $showtime, $theater, $seat_no, $no_of_tickets, $total_price, $user);

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
    <link href="../../public/css/app.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Add New Booking</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">User</label>
                    <select name="user" id="" class="form-select">
                        <option value="" selected disabled>Select user</option>
                        <?php
                        foreach ($users as $user) {
                        ?>
                            <option value="<?php echo $user['id']; ?>" <?php if ((isset($_POST['user']) && $_POST['user']) == $user['id']) echo 'selected'; ?>>
                                <?php echo $user['name']; ?>
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
                    <label for="" class="form-label">Seat No</label>
                    <input type="text" name="seat_no" value="<?php if (isset($_POST['seat_no'])) echo $_POST['seat_no']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">No of Tickets</label>
                    <input type="text" name="no_of_tickets" value="<?php if (isset($_POST['no_of_tickets'])) echo $_POST['no_of_tickets']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Total Price</label>
                    <input type="text" name="total_price" value="<?php if (isset($_POST['total_price'])) echo $_POST['total_price']; ?>" class="form-control">
                </div>

                <!-- <div class="my-3">
                    <label for="" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" value="<?php if (isset($_POST['customer_name'])) echo $_POST['customer_name']; ?>" class="form-control">
                </div> -->

                <!-- <div class="my-3">
                    <label for="" class="form-label">Customer Phone</label>
                    <input type="text" name="customer_phone" value="<?php if (isset($_POST['customer_phone'])) echo $_POST['customer_phone']; ?>" class="form-control">
                </div> -->

                <div class="mt-3">
                    <button class="btn btn-success" type="submit" name="submit">Add</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../../public/js/app.js"></script>

</body>

</html>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>