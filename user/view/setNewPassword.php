<?php

session_name('user_session');
session_start();
include_once  __DIR__ . '/../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $email = $_SESSION['email'];

    if ($password === $con_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $status = $auth_controller->updatePassword($hashed_password, $email);
        if ($status) {
            $user_info = $auth_controller->getUsers();
            foreach ($user_info as $user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
            }
            echo '<script>location.href="index.php"</script>';
            exit;
        }
    } else {
        $error = "Password and confirm password do not match.";
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
            <label for="" class="form-lable">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="" class="form-lable">Confirm Password</label>
            <input type="password" name="con_password" class="form-control">
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