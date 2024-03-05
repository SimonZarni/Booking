<?php

session_name('user_session');
session_start();
include_once  __DIR__ . '/../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $otp = $auth_controller->resetPassword($email);

    if (!empty($otp)) {
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        header('location:verify_otp.php');
    } else {
        $error = 'We have an error while sending OTP code. Please try again.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/font-awesome.min.css" rel="stylesheet">
    <link href="../public/css/global.css" rel="stylesheet">
    <link href="../public/css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>

<body>
    <form action="" method="post">
        <h4>Reset Password</h4>
        <div class="col-md-3">
            <label for="" class="form-lable">Email</label>
            <input type="email" name="email" placeholder="Enter your email" class="form-control">
        </div>
        <?php
        if(isset($error)){
            echo "<span class='text-danger'>$error</span>";
        }
        ?>
        <div class="col-md-3 mt-2">
            <button type="submit" class="btn btn-success" name="submit">Continue</button>
        </div>
    </form>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="../public/js/myscript.js"></script>
</body>

</html>