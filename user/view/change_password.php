<?php

session_name('user_session');
session_start();
include_once  __DIR__ . '/../controller/AuthenticationController.php';

if (isset($_POST['submit'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $con_newPassword = $_POST['con_newPassword'];

    $user_id = $_SESSION['user_id'];
    $auth_controller = new AuthenticationController();
    $user = $auth_controller->getUserById($user_id);
    if (password_verify($old_password, $user['password'])) {
        if ($new_password === $con_newPassword) { 
            $status = $auth_controller->changePassword(password_hash($new_password, PASSWORD_DEFAULT), $user_id);

            if ($status) {
                header('location: index.php');
                exit();
            } else {
                $error = "Failed to update password.";
            }
        } else {
            $error = "New password and confirm new password do not match.";
        }
    } else {
        $error = "Old password is incorrect.";
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
    <div class="container-fluid">
        <form action="" method="post">
            <div class="my-3">
                <label for="" class="form-label">Old Password</label>
                <input type="password" name="old_password" value="" class="form-control">
            </div>
            <div class="my-3">
                <label for="" class="form-label">New Password</label>
                <input type="password" name="new_password" value="" class="form-control">
            </div>
            <div class="my-3">
                <label for="" class="form-label">Confirm New Password</label>
                <input type="password" name="con_newPassword" value="" class="form-control">
            </div>
            <div class="mt-3">
                <button class="btn btn-success" name="submit" type="submit">Update password</button>
            </div>
            <?php
            if (isset($error)) {
                echo "<span class='text-danger'>$error</span>";
            }
            ?>
        </form>
    </div>

    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="../public/js/myscript.js"></script>

</body>

</html>