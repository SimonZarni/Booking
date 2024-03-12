<?php

include_once  __DIR__. '/../../controller/PaymentController.php';
include_once  __DIR__. '/../../controller/BookingPaymentController.php';

// if(isset($_GET['id'])){
//     $id = $_GET['id'];

//     $payment_controller=new PaymentController();
//     $result = $payment_controller->deletePayment($id);

//     if($result){
//         echo "<script>location.href='payment_method.php'</script>";
//     } 
//     else {
//         echo "Failed to delete payment.";
//     }
// }

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$payment_controller = new PaymentController();

$booking_payment_controller = new BookingPaymentController();
$booking_payments = $booking_payment_controller->getBookingPayments();

$pay_related = false;
foreach($booking_payments as $booking_payment){
    if($booking_payment['payment_type_id'] == $id){
        $pay_related = true;
        break; 
    }
}

if(!$pay_related){
    $status = $payment_controller->deletePayment($id);    
    header('location: payment_method.php?delete_success=delete');
} else {
    header('location: payment_method.php?delete_status=fail');    
}

?>