<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__. '/../model/BookingPayment.php';
include_once __DIR__.'/../vendor/PhpMailer/src/Exception.php';
include_once __DIR__.'/../vendor/PhpMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PhpMailer/src/SMTP.php';

class BookingPaymentController extends BookingPayment {

    public function getBookingPayments(){
        return $this->getBookingPaymentInfo();
    }

    public function createBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price){
        return $this->addBookingPayment($booking,$customer_name,$payment_type,$account_no,$total_price);
    }

    public function getBookingPaymentById($id){
        return $this->getBookingPaymentList($id);
    }

    public function editBookingPayment($id,$booking,$customer_name,$show_time,$payment_type,$account_no,$total_price){
        return $this->updateBookingPaymentInfo($id,$booking,$customer_name,$show_time,$payment_type,$account_no,$total_price);
    }

    public function deleteBookingPayment($id){
        return $this->deleteBookingPaymentInfo($id);
    }

    public function acceptPayment($id){
        return $this->acceptBookingPayment($id);
    }

    public function declinePayment($id){
        return $this->declineBookingPayment($id);
    }

    public function sendMail($email){   
        $mailer = new PHPMailer(true);

        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;

        $mailer->Username = "simonzarni03@gmail.com";
        $mailer->Password = "zgkw ngcn ycry czzz";

        $mailer->setFrom("simonzarni03@gmail.com","Cinemax");
        $mailer->addAddress($email);

        $mailer->IsHTML(true);
        $mailer->Subject = "Your payment process is in progress.";
        $mailer->Body = 'Your payment has been accepted.';

        if ($mailer->send())
        {
            return true;
        }
    }
} 

?>