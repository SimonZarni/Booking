<?php

session_start();
// include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/AuthenticationController.php';

if (isset($_POST['otp_submit'])) {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    if ($_POST['otp'] == $_SESSION['otp']) {
        $auth_controller = new AuthenticationController();
        $status = $auth_controller->createUser($name, $email, $password);
        if (!empty($status)) {
            $id = $auth_controller->getUserByEmail($status);
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            echo '<script>location.href="index.php"</script>';
        }
    } else {
        $otp_error = "Invalid OTP";
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
        <div class="col-md-3">
            <label for="" class="form-lable">OTP</label>
            <input type="number" placeholder="Enter your OTP code here" name="otp" class="form-control">
        </div>
        <div class="col-md-3 mt-2">
            <input type="submit" class="btn btn-success" name="otp_submit">
        </div>
        <?php if (isset($otpError)) echo '<span class="text-danger">' . $otp_error . '</span>'; ?>
    </form>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="../public/js/myscript.js"></script>

</body>

</html>