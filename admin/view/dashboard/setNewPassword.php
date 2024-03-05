<?php

session_start();
include_once  __DIR__ . '/../../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $email = $_SESSION['email'];

    if ($password === $con_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $status = $auth_controller->updatePassword($hashed_password, $email);
        if ($status) {
            $admin_info = $auth_controller->getAdmins();
            foreach ($admin_info as $admin) {
                $_SESSION['id'] = $admin['id'];
                $_SESSION['name'] = $admin['name'];
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
    <link href="../../public/css/app.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png"/>
	<link rel="canonical" href="https://demo-basic.adminkit.io/"/>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="../../public/js/app.js"></script>
	<script src="../../public/js/myscript.js"></script>
</body>

</html>