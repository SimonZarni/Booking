<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once  __DIR__ . '/../controller/BookingPaymentController.php';
include_once  __DIR__ . '/../controller/BookingController.php';
include_once  __DIR__ . '/../controller/PaymentController.php';

$booking_payment_controller = new BookingPaymentController();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$booking_controller = new BookingController();
$bookings = $booking_controller->getBookings($user_id);

$id = $_GET['id'];
$booking = $booking_controller->getBookingById($id);

$payment_controller = new PaymentController();
$payments = $payment_controller->getPayments();

if (isset($_POST['submit'])) {
    $booking = $_POST['booking'];
    $user_name = $_SESSION['user_name'];
    $payment_type = $_POST['payment'];
    $account_no = $_POST['account_no'];
    $total_price = $_POST['total_price'];
    $user_id = $_SESSION['user_id'];
    $payment_date = date('Y-m-d');
    $pay_status = $booking_payment_controller->createBookingPayment($booking, $user_name, $payment_type, $account_no, $total_price, $user_id, $payment_date);

    if ($pay_status) {
        $id = $_GET['id'];
        $pay_controller = new BookingController();
        $paid = $pay_controller->makePayment($id);
        echo '<script>location.href="payment.php?pay_status=' . $pay_status . '"</script>';
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
                    <select name="total_price" class="form-select">
                        <option value="<?php echo $booking['total_price']; ?>" selected><?php echo $booking['total_price']; ?></option>
                    </select>
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