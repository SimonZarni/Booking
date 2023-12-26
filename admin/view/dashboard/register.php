<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once __DIR__. '/../../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();
$conPasswordError = "";

if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
	$con_password = $_POST['con_password'];

	if($_POST['password'] != $_POST['con_password'])
        $conPasswordError = 'Password and Confirm Password must be the same.';
	else {
		$status = $auth_controller->createAdmin($name,$email,$password);
		if($status){
			echo '<script>location.href="index.php?"</script>';
			exit;
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Get started</h1>
							<p class="lead">
								Start creating the best possible user experience for you customers.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form action="" method="post">
										<div class="mb-3">
											<label class="form-label">Full name</label>
											<input class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" />
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control form-control-lg" type="password" name="con_password" placeholder="Enter confirm password" value="<?php if(isset($_POST['con_password'])) echo $_POST['con_password']; ?>" />
										</div>
										<?php 
										if(isset($conPasswordError))  echo '<span class="text-danger">'.$conPasswordError.'</span>'; 
										?>
										<div class="d-grid gap-2 mt-3">
											<button class="btn btn-lg btn-primary" type="submit" name="submit">Sign up</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Already have account? <a href="login.php">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

<script src="../../public/js/app.js"></script>
<script src="../../public/js/myscript.js"></script>

</body>

</html>

<?php
include_once __DIR__. '/../../layouts/admin_footer.php';
?>