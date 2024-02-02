<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/PaymentController.php';

$payment_controller = new PaymentController();
$payments = $payment_controller->getPayments();

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
    if(isset($_GET['status']) && $_GET['status']==true)
    {
        echo "<span class='text-success'>New Payment has been added successfully.</span>";
    }
    ?>

    <?php
    if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
    {
        echo "<span class='text-success'>Payment has been updated successfully.</span>";
    }
    ?>

    <div class="col-md-4 mt-3">
        <a class='btn btn-success p-2' href='addPayment.php'>Add New Payment</a>
    </div>
<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="payTable">
            <thead>
                <th>No</th>
                <th>Show Time</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                    foreach ($payments as $payment) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $payment['payment_type'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary' href='editPayment.php?id=".$payment['id']."'>Edit</a>";
                    echo "<a class='btn btn-danger mx-2' href='deletePayment.php?id=".$payment['id']."' onclick='return deletePayment()'>Delete</a>";
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

