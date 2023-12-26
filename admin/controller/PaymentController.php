<?php

include_once __DIR__. '/../model/Payment.php';

class PaymentController extends Payment{

    public function getPayments(){
        return $this->getPaymentInfo();
    }

    public function createPayment($payment){
        return $this->addPayment($payment);
    }

    public function getPaymentById($id){
        return $this->getPaymentList($id);
    }

    public function editPayment($id,$name){
        return $this->updatePaymentInfo($id,$name);
    }

    public function deletePayment($id){
        return $this->deletePaymentInfo($id);
    }
}

?>