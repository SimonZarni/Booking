<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__. '/../model/Authentication.php';
include_once __DIR__.'/../vendor/PhpMailer/src/Exception.php';
include_once __DIR__.'/../vendor/PhpMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PhpMailer/src/SMTP.php';

class AuthenticationController extends Authentication {

    public function getUsers(){
        return $this->getUserInfo();
    }

    public function createUser($name,$email,$password){
        return $this->addUser($name,$email,$password);
    }

    public function getUserById($id){
        return $this->getUserList($id);
    }

    public function sendMail($email){
        $otp = rand(1000,9999);
   
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
        $mailer->Subject = "Your account registration is in progress.";
        $mailer->Body = 'Your OTP code is '.$otp.'.';

        if ($mailer->send())
        {
            return $otp;
        }
    }

    public function changePassword($password,$id){
        return $this->updatePassword($password,$id);
    }

    public function emailExists($email){
        return $this->isEmailExists($email);
    }

    public function resetPassword($email){
        $otp = rand(1000, 9999);

        $mailer = new PHPMailer(true);

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
        $mailer->Subject = "Reset your password with OTP code.";
        $mailer->Body = 'Your OTP code is ' . $otp.'.';

        if ($mailer->send()) {
            return $otp;
        }
    }

    public function updatePassword($password,$email){
        return $this->editPassword($password,$email);
    }
}

?>