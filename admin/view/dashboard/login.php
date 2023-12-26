<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once __DIR__. '/../../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();
$admins = $auth_controller->getAdmins();

if (isset($_POST['submit'])) {
    foreach ($admins as $admin) {
        if ($_POST['email'] == $admin['email'] && password_verify($_POST['password'], $admin['password'])) {
			echo '<script>location.href="index.php?"</script>';
            exit();
        } else {
			$passwordError = "Invalid email or password.";
		}
    }
}

if(isset($_SESSION['id'])){
	echo '<script>location.href="index.php?"</script>';
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
							<h1 class="h2">Welcome back!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form action="" method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/>
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>"/>
										</div>
										<div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
												<label class="form-check-label text-small" for="customControlInline">Remember me</label>
											</div>
										</div>
										<?php
										if(isset($passwordError)) echo '<span class="text-danger">'.$passwordError.'</span>'; 
										?>
										<div class="d-grid gap-2 mt-3">
											<button class="btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Don't have an account? <a href="register.php">Sign up</a>
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