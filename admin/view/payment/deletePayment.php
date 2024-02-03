<?php

include_once  __DIR__. '/../../controller/PaymentController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $payment_controller=new PaymentController();
    $result = $payment_controller->deletePayment($id);

    if($result){
        echo "<script>location.href='payment_method.php'</script>";
    } 
    else {
        echo "Failed to delete payment.";
    }
}

?>