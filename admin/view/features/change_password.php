<?php

session_start();
include_once __DIR__ . '/../../controller/AuthenticationController.php';

if (isset($_POST['submit'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $con_newPassword = $_POST['con_newPassword'];

    $id = $_SESSION['id'];
    $auth_controller = new AuthenticationController();
    $admin = $auth_controller->getAdminById($id);
    if (password_verify($old_password, $admin['password'])) {
        if ($new_password === $con_newPassword) {
            $status = $auth_controller->changePassword(password_hash($new_password, PASSWORD_DEFAULT), $id);

            if ($status) {
                header('location: ../dashboard/index.php');
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
    <link href="../../public/css/app.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../public/js/app.js"></script>
    <script src="../../public/js/myscript.js"></script>

</body>

</html>