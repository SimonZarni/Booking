<?php

// include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__ . '/../../controller/BookingPaymentController.php';
include_once  __DIR__ . '/../../controller/BookingController.php';
include_once  __DIR__ . '/../../controller/ShowTimeController.php';
include_once  __DIR__ . '/../../controller/PaymentController.php';
include_once  __DIR__ . '/../../controller/UserController.php';

$booking_payment_controller = new BookingPaymentController();

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
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Add New Booking Payment</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">User Name</label>
                    <select name="user_name" id="" class="form-select">
                        <option value="" selected disabled>Select User Name</option>
                        <?php
                        foreach ($bookings as $booking) {
                        ?>
                            <option value="<?php echo $booking['customer_name']; ?>">
                                <?php echo $booking['customer_name']; ?>
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
                        foreach ($bookings as $booking) {
                        ?>
                            <option value="<?php echo $booking['user_id']; ?>" <?php if ((isset($_POST['user_id']) && $_POST['user_id']) == $booking['user_id']) echo 'selected'; ?>>
                                <?php echo $booking['user_id']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Booking ID</label>
                    <select name="booking" id="" class="form-select">
                        <option value="" selected disabled>Select Booking ID</option>
                        <?php
                        foreach ($bookings as $booking) {
                        ?>
                            <option value="<?php echo $booking['id']; ?>" <?php if ((isset($_POST['booking']) && $_POST['booking']) == $booking['id']) echo 'selected'; ?>>
                                <?php echo $booking['id']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Payment Type</label>
                    <select name="payment_type" id="" class="form-select">
                        <option value="" selected disabled>Select Payment Type</option>
                        <?php
                        foreach ($payments as $payment) {
                        ?>
                            <option value="<?php echo $payment['id']; ?>" <?php if ((isset($_POST['payment_type']) && $_POST['payment_type']) == $payment['id']) echo 'selected'; ?>>
                                <?php echo $payment['payment_type']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Account No</label>
                    <input type="text" name="account_no" value="<?php if (isset($_POST['account_no'])) echo $_POST['account_no']; ?>" class="form-control" required>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Total Price</label>
                    <select name="total_price" id="" class="form-select">
                        <option value="" selected disabled>Select Total Price</option>
                        <?php
                        foreach ($bookings as $booking) {
                        ?>
                            <option value="<?php echo $booking['total_price']; ?>">
                                <?php echo $booking['total_price']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit" name="submit">Add</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../../public/js/app.js"></script>

</body>

</html>

<!-- <?php
        include_once __DIR__ . '/../../layouts/admin_footer.php';
        ?> -->