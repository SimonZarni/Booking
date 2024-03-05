<?php

session_name('user_session');
session_start();

if (isset($_POST['submit'])) {
    if ($_POST['otp'] == $_SESSION['otp']) {
        header("location:setNewPassword.php");
    } else {
        $error = 'Invalid OTP';
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
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
        </div>
        <?php if (isset($error)) echo '<span class="text-danger">' . $error . '</span>'; ?>
    </form>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="../public/js/myscript.js"></script>
</body>

</html>