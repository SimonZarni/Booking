<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/PaymentController.php';

$payment_controller = new PaymentController();

if(isset($_POST['submit'])){
    $payment = $_POST['name'];
    $status = $payment_controller->createPayment($payment);

    if($status){
        echo '<script>location.href="payment_method.php?status=' .$status. '"</script>';
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
        <h2><strong>Add New Payment</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Show Time</label>
                    <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" class="form-control">
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

<?php
include_once  __DIR__. '/../../layouts/admin_footer.php';
?>