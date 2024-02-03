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
<h2 class="mt-1"><strong>Payments</strong></h2>
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

<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="payBookTable">
            <thead>
                <th>No</th>
                <th>Booking ID</th>
                <th>Customer Name</th>
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
                    echo "<td>" . $booking_payment['payment_type'] . "</td>";
                    echo "<td>" . $booking_payment['account_no'] . "</td>";
                    echo "<td>" . $booking_payment['total_price'] . "</td>";
                    if ($booking_payment['status'] == 'Accepted') {
                        echo "<td class='text-success'>" . $booking_payment['status'] . "</td>"; 
                    } elseif ($booking_payment['status'] == 'Declined') {
                        echo "<td class='text-danger'>" . $booking_payment['status'] . "</td>"; 
                    } else {
                        echo "<td>Pending</td>";
                    }
                    echo "<td>";
                    if ($booking_payment['status'] == null){
                        echo "<a class='btn btn-success' href='acceptPayment.php?id=".$booking_payment['id']."'>Accept</a>";
                        echo "<a class='btn btn-danger mx-2' href='declinePayment.php?id=".$booking_payment['id']."'>Decline</a>";
                    }        
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>

<?php
include_once  __DIR__. '/../../layouts/admin_footer.php';
?>