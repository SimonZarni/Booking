<?php

include_once __DIR__. '/../model/Payment.php';

class PaymentController extends Payment{

    public function getPayments(){
        return $this->getPaymentInfo();
    }
}

?>