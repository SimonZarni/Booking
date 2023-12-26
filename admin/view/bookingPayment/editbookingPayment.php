<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/BookingPaymentController.php';
include_once  __DIR__. '/../../controller/BookingController.php';
include_once  __DIR__. '/../../controller/ShowTimeController.php';
include_once  __DIR__. '/../../controller/PaymentController.php';

$id = $_GET['id'];

$booking_payment_controller = new BookingPaymentController();
$booking_payment = $booking_payment_controller->getBookingPaymentById($id);

$booking_controller = new BookingController();
$bookings = $booking_controller->getBookings();

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

$payment_controller = new PaymentController();
$payments = $payment_controller->getPayments();

if (isset($_POST['submit'])) {
    $booking = $_POST['booking'];
    $customer_name = $_POST['customer_name'];
    $showtime = $_POST['show_time'];
    $payment_type = $_POST['payment'];
    $account_no = $_POST['account_no'];
    $total_price = $_POST['total_price'];
    $updateStatus = $booking_payment_controller->editBookingPayment($id,$booking,$customer_name,$showtime,$payment_type,$account_no,$total_price);

    if($updateStatus){
        echo '<script>location.href="bookingPayment.php?updateStatus=' . $updateStatus . '"</script>';
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
        <h2><strong>Edit Booking Payment</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="my-3">
                    <label for="" class="form-label">Booking ID</label>
                    <select name="booking" id="" class="form-select">
                        <option value="" selected disabled>Select Booking ID</option>
                        <?php
                        foreach ($bookings as $booking) {
                            $selected = ($booking['booking'] == $booking_payment['movie_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $booking['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $booking['id']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" value="<?php echo $booking_payment['customer_name']; ?>" class="form-control">
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
                    <label for="" class="form-label">Booking Payment</label>
                    <select name="payment" id="" class="form-select">
                        <option value="" selected disabled>Select booking payment</option>
                        <?php
                        foreach ($payments as $payment) {
                            $selected = ($payment['id'] == $booking_payment['booking_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $payment['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $payment['payment_type']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Account No</label>
                    <input type="text" name="account_no" value="<?php echo $booking_payment['account_no']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Total Price</label>
                    <input type="text" name="total_price" value="<?php echo $booking_payment['total_price']; ?>" class="form-control">
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