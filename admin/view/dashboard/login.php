<?php

session_start();
include_once __DIR__ . '/../../controller/AuthenticationController.php';

$auth_controller = new AuthenticationController();
$admins = $auth_controller->getAdmins();

if (isset($_POST['submit'])) {
	foreach ($admins as $admin) {
		if ($_POST['email'] == $admin['email'] && password_verify($_POST['password'], $admin['password'])) {
			$_SESSION['id'] = $admin['id'];
			$_SESSION['name'] = $admin['name'];
			echo '<script>location.href="index.php"</script>';
			exit();
		} else {
			$passwordError = "Invalid email or password.";
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
	<link href="../../public/css/app.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png"/>
	<link rel="canonical" href="https://demo-basic.adminkit.io/"/>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center">
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
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" value="" />
										</div>
										<div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
												<label class="form-check-label text-small" for="customControlInline">Remember me</label>
											</div>
										</div>
										<div>
											<a href="forget_password.php">Forgot password?</a>
										</div>
										<?php
										if (!empty($passwordError)) echo '<span class="text-danger">' . $passwordError . '</span>';
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

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="../../public/js/app.js"></script>
	<script src="../../public/js/myscript.js"></script>

</body>

</html>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>