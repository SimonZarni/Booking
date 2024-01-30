<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/BookingPaymentController.php';

$booking_payment_controller = new BookingPaymentController();
$booking_payments = $booking_payment_controller->getBookingPayments();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 class="mt-1"><strong>Booking Payment</strong></h2>
    <?php
    if(isset($_GET['status']) && $_GET['status']==true)
    {
        echo "<span class='text-success'>Booking has been paid successfully.</span>";
    }
    
    if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
    {
        echo "<span class='text-success'>Booking Payment has been updated successfully.</span>";
    }

    if(isset($_GET['acceptstatus']) && $_GET['acceptstatus']==true)
    {
        echo "<span class='text-success'>User payment has been accepted.</span>";
    }

    if(isset($_GET['declinestatus']) && $_GET['declinestatus']==true)
    {
        echo "<span class='text-success'>User payment has been declined.</span>";
    }
    ?>

    <div class="col-md-4 mt-3">
        <a class='btn btn-success p-2' href='addbookingPayment.php?'>Add New Booking Payment</a>
    </div>
<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="mytable">
            <thead>
                <th>No</th>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Show Time</th>
                <th>Payment Type</th>
                <th>Account No</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                    foreach ($booking_payments as $booking_payment) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $booking_payment['booking_id'] . "</td>";
                    echo "<td>" . $booking_payment['customer_name'] . "</td>";
                    echo "<td>" . $booking_payment['show_time'] . "</td>";
                    echo "<td>" . $booking_payment['payment_type'] . "</td>";
                    echo "<td>" . $booking_payment['account_no'] . "</td>";
                    echo "<td>" . $booking_payment['total_price'] . "</td>";
                    echo "<td>" . $booking_payment['status'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary' href='editbookingPayment.php?id=".$booking_payment['id']."'>Edit</a>";
                    echo "<a class='btn btn-danger mx-2' href='deletebookingPayment.php?id=".$booking_payment['id']."' onclick='return deletebookingPayment()'>Delete</a>";
                    echo "<a class='btn btn-primary' href='acceptPayment.php?id=".$booking_payment['id']."'>Accept</a>";
                    echo "<a class='btn btn-danger mx-2' href='declinePayment.php?id=".$booking_payment['id']."'>Decline</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../../public/js/app.js"></script>
<script src="../../public/js/myscript.js"></script>

</body>

</html>

<?php
include_once  __DIR__. '/../../layouts/admin_footer.php';
?>