<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../model/BookingPayment.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/Exception.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/PHPMailer.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/SMTP.php';

class BookingPaymentController extends BookingPayment
{

    public function getBookingPayments()
    {
        return $this->getBookingPaymentInfo();
    }

    public function createBookingPayment($booking, $user_name, $payment_type, $account_no, $total_price, $user_id, $payment_date)
    {
        return $this->addBookingPayment($booking, $user_name, $payment_type, $account_no, $total_price, $user_id, $payment_date);
    }

    public function getBookingPaymentById($id)
    {
        return $this->getBookingPaymentList($id);
    }

    public function editBookingPayment($id, $booking, $customer_name, $show_time, $payment_type, $account_no, $total_price)
    {
        return $this->updateBookingPaymentInfo($id, $booking, $customer_name, $show_time, $payment_type, $account_no, $total_price);
    }

    public function deleteBookingPayment($id)
    {
        return $this->deleteBookingPaymentInfo($id);
    }

    public function acceptPayment($id)
    {
        $accepted = $this->acceptBookingPayment($id);
        if ($accepted) {
            $email = $this->emailByPayment($id);
            if ($email) {
                $invoiceDetails = $this->getBookingPaymentById($id);
                $message = "Your payment has been accepted. Thank you for your payment. Enjoy the movie!<br>";
                $message .= "Invoice Details:<br>";
                $message .= "Invoice ID: $id<br>";
                $message .= "Customer Name: " . $invoiceDetails['customer_name'] . "<br>";
                $message .= "Total Price: " . $invoiceDetails['total_price'] . "<br>";
                $message .= "Payment Date: " . $invoiceDetails['payment_date'] . "<br>";
                return $this->sendMail($email, $message);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function declinePayment($id)
    {
        $declined = $this->declineBookingPayment($id);
        if ($declined) {
            $email = $this->emailByPayment($id);
            if ($email) {
                $message = "Your payment has been declined due to some reasons. Please contact us for further information. (cinemax@gmail.com)";
                return $this->sendMail($email, $message);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function sendMail($email, $message)
    {
        $mailer = new PHPMailer(true);

        try {
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = 587;

            $mailer->Username = "simonzarni03@gmail.com";
            $mailer->Password = "zgkw ngcn ycry czzz";

            $mailer->setFrom("simonzarni03@gmail.com", "Cinemax");
            $mailer->addAddress($email);

            $mailer->IsHTML(true);
            $mailer->Subject = "Your payment status";
            $mailer->Body = $message;

            if ($mailer->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
            return false;
        }
    }
}
