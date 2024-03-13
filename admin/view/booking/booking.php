<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/BookingController.php';
include_once  __DIR__ . '/../../controller/MovieController.php';
include_once  __DIR__ . '/../../controller/ShowTimeController.php';
include_once  __DIR__ . '/../../controller/TheaterController.php';
include_once  __DIR__ . '/../../controller/UserController.php';

$booking_controller = new BookingController();
$bookings = $booking_controller->getBookings();

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
    $seat_no = $_POST['seat_no'];
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
</head>

<body>
    <h2 class="mt-1"><strong>Booking</strong></h2>
    <?php
    if (isset($_GET['status']) && $_GET['status'] == true) {
        echo "<span class='text-success'>New Booking has been added successfully.</span>";
    }
    ?>

    <?php
    if (isset($_GET['updateStatus']) && $_GET['updateStatus'] == true) {
        echo "<span class='text-success'>Booking has been updated successfully.</span>";
    }
    ?>
    <div class="col-md-4 mt-3">
        <a class='btn btn-success p-2' href='addBooking.php'>Add New Booking</a>
        <!-- <a id="addBookingBtn" class='btn btn-success p-2' href='addBooking.php'>Add New Booking</a> -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped" id="bookTable">
                <thead>
                    <th>ID</th>
                    <th>User</th>
                    <th>Movie</th>
                    <th>Date</th>
                    <th>Show Time</th>
                    <th>Theater</th>
                    <th>Seat No</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($bookings as $booking) {
                        echo "<tr>";
                        echo "<td>" . $booking['id'] . "</td>";
                        echo "<td>" . $booking['customer_name'] . "</td>";
                        echo "<td>" . $booking['movie_name'] . "</td>";
                        echo "<td>" . $booking['date'] . "</td>";
                        echo "<td>" . $booking['show_time'] . "</td>";
                        echo "<td>" . $booking['theater'] . "</td>";
                        echo "<td>" . $booking['seat_no'] . "</td>";
                        echo "<td>" . $booking['total_price'] . "</td>";
                        if ($booking['payment_status'] == 'Paid') {
                            echo "<td class='text-success'>" . $booking['payment_status'] . "</td>";
                        } else {
                            echo "<td class='text-danger'>Unpaid</td>";
                        }
                        echo "<td>";
                        echo "<a class='btn btn-danger mx-2' href='deleteBooking.php?id=" . $booking['id'] . "' onclick='return deleteBooking()'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var addCategoryBtn = document.getElementById('addBookingBtn');
        var modal = document.getElementById('myModal');
        var modalContent = document.getElementById('modalContent');

        addCategoryBtn.addEventListener('click', function(event) {
            event.preventDefault();
            var url = this.getAttribute('href');
            loadModalContent(url);
        });

        function loadModalContent(url) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        modalContent.innerHTML = xhr.responseText;
                        modal.style.display = "block";
                    } else {
                        console.error('Error loading content');
                    }
                }
            };
            xhr.open('GET', url, true);
            xhr.send();
        }

        var closeBtn = document.getElementsByClassName("close")[0];
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>

<?php
include_once  __DIR__ . '/../../layouts/admin_footer.php';
?>