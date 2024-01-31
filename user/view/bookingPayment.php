<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once  __DIR__ . '/../controller/BookingPaymentController.php';
include_once  __DIR__ . '/../controller/BookingController.php';
include_once  __DIR__ . '/../controller/ShowTimeController.php';
include_once  __DIR__ . '/../controller/PaymentController.php';

$booking_payment_controller = new BookingPaymentController();

$booking_controller = new BookingController();
$bookings = $booking_controller->getBookings();

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

$payment_controller = new PaymentController();
$payments = $payment_controller->getPayments();

if (isset($_POST['submit'])) {
    $booking = $_POST['booking'];
    $customer_name = $_POST['user'];
    $showtime = $_POST['show_time'];
    $payment_type = $_POST['payment'];
    $account_no = $_POST['account_no'];
    $total_price = $_POST['total_price'];
    $pay_status = $booking_payment_controller->createBookingPayment($booking, $customer_name, $showtime, $payment_type, $account_no, $total_price);

    if ($pay_status) {
        echo '<script>location.href="index.php?pay_status=' . $pay_status . '"</script>';
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
            <h2><strong>Make Payment</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">User</label>
                    <input type="text" name="user" value="<?php if (isset($_SESSION['name'])) echo $_SESSION['name']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Booking ID</label>
                    <select name="booking" id="" class="form-select">
                        <option value="" selected disabled>Select booking ID</option>
                        <?php
                        $selectedBookingId = isset($_POST['booking']) ? $_POST['booking'] : (isset($_GET['id']) ? $_GET['id'] : null);

                        foreach ($bookings as $booking) {
                            if ($selectedBookingId !== null && $selectedBookingId == $booking['id']) {
                        ?>
                                <option value="<?php echo $booking['id']; ?>" selected>
                                    <?php echo $booking['id']; ?>
                                </option>
                        <?php
                                break;
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- <div class="my-3">
                    <label for="" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" value="<?php if (isset($_POST['customer_name'])) echo $_POST['customer_name']; ?>" class="form-control">
                </div> -->

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
                    <label for="" class="form-label">Payment</label>
                    <select name="payment" id="" class="form-select">
                        <option value="" selected disabled>Select payment</option>
                        <?php
                        foreach ($payments as $payment) {
                        ?>
                            <option value="<?php echo $payment['id']; ?>" <?php if ((isset($_POST['payment']) && $_POST['payment']) == $payment['id']) echo 'selected'; ?>>
                                <?php echo $payment['payment_type']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Account No</label>
                    <input type="text" name="account_no" value="<?php if (isset($_POST['account_no'])) echo $_POST['account_no']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Total Price</label>
                    <input type="text" name="total_price" value="<?php if (isset($_POST['total_price'])) echo $_POST['total_price']; ?>" class="form-control">
                </div>

                <div class="mt-3">
                    <button class="btn btn-danger" type="submit" name="submit">Pay</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
include_once __DIR__ . '/../layouts/footer.php';
?>