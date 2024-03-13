<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/BookingPaymentController.php';
include_once  __DIR__ . '/../../controller/BookingController.php';
include_once  __DIR__ . '/../../controller/ShowTimeController.php';
include_once  __DIR__ . '/../../controller/PaymentController.php';
include_once  __DIR__ . '/../../controller/UserController.php';

$booking_payment_controller = new BookingPaymentController();
$booking_payments = $booking_payment_controller->getBookingPayments();

$booking_controller = new BookingController();
$bookings = $booking_controller->getBookings();

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

$payment_controller = new PaymentController();
$payments = $payment_controller->getPayments();

$user_controller = new UserController();
$users = $user_controller->getUsers();

if (isset($_POST['submit'])) {
    $booking = $_POST['booking'];
    $payment_type = $_POST['payment_type'];
    $account_no = $_POST['account_no'];
    $total_price = $_POST['total_price'];
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $payment_date = date('Y-m-d');
    $status = $booking_payment_controller->createBookingPayment($booking, $user_name, $payment_type, $account_no, $total_price, $user_id, $payment_date);

    if ($status) {
        echo '<script>location.href="payment.php?status=' . $status . '"</script>';
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
    <h2 class="mt-1"><strong>Payment</strong></h2>
    <?php
    if (isset($_GET['status']) && $_GET['status'] == true) {
        echo "<div class='alert alert-success'>Booking has been paid successfully.</div>";
    }

    if (isset($_GET['updateStatus']) && $_GET['updateStatus'] == true) {
        echo "<div class='alert alert-success'>Booking Payment has been updated successfully.</div>";
    }

    if (isset($_GET['acceptstatus']) && $_GET['acceptstatus'] == true) {
        echo "<div class='alert alert-success'>User payment has been accepted.</div>";
    }

    if (isset($_GET['declinestatus']) && $_GET['declinestatus'] == true) {
        echo "<div class='alert alert-danger'>User payment has been declined.</div>";
    }
    ?>

    <!-- <div class="col-md-4 mt-3">
        <a id="addBookingPayBtn" class="btn btn-success p-2" href="addbookingPayment.php">Add New Payment</a>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
    </div> -->
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped" id="payBookTable">
                <thead>
                    <th>ID</th>
                    <th>Booking ID</th>
                    <th>Customer Name</th>
                    <th>Payment Type</th>
                    <th>Account No</th>
                    <th>Total Price</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($booking_payments as $booking_payment) {
                        echo "<tr>";
                        echo "<td>" . $booking_payment['id'] . "</td>";
                        echo "<td>" . $booking_payment['booking_id'] . "</td>";
                        echo "<td>" . $booking_payment['customer_name'] . "</td>";
                        echo "<td>" . $booking_payment['payment_type'] . "</td>";
                        echo "<td>" . $booking_payment['account_no'] . "</td>";
                        echo "<td>" . $booking_payment['total_price'] . "</td>";
                        echo "<td>" . $booking_payment['payment_date'] . "</td>";
                        if ($booking_payment['status'] == 'Accepted') {
                            echo "<td class='text-success'>" . $booking_payment['status'] . "</td>";
                        } elseif ($booking_payment['status'] == 'Declined') {
                            echo "<td class='text-danger'>" . $booking_payment['status'] . "</td>";
                        } else {
                            echo "<td>Pending</td>";
                        }
                        echo "<td>";
                        if ($booking_payment['status'] == null) {
                            echo "<a class='btn btn-danger mx-2' href='deletebookingPayment.php?id=" . $booking_payment['id'] . "' onclick='return deletebookingPayment()'>Delete</a>";
                            echo "<a class='btn btn-success' href='acceptPayment.php?id=" . $booking_payment['id'] . "'>Accept</a>";
                            echo "<a class='btn btn-danger mx-2' href='declinePayment.php?id=" . $booking_payment['id'] . "'>Decline</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var addCategoryBtn = document.getElementById('addBookingPayBtn');
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