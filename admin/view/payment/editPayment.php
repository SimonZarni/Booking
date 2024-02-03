<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/PaymentController.php';

$id = $_GET['id'];

$payment_controller = new PaymentController();
$payment = $payment_controller->getPaymentById($id);

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $updateStatus = $payment_controller->editPayment($id,$name);

    if($updateStatus){
        echo '<script>location.href="payment_method.php?updateStatus=' .$updateStatus. '"</script>';
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
        <h2><strong>Edit Payment</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Payment</label>
                    <input type="text" name="name" class="form-control" value="<?php if(isset($payment['payment_type'])) echo $payment['payment_type']; ?>">
                </div>

                <div class="mt-3">
                    <button class = "btn btn-success" name = "submit">Update</button>
                </div>
            </form>
    </div>
</div>

</body>

</html>

<?php
include_once __DIR__. '/../../layouts/admin_footer.php';
?>