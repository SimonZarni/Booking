<?php

session_start();
include_once __DIR__ . '/../controller/AuthenticationController.php';

$auth = new AuthenticationController();
$auth->authentication();

if (isset($_SESSION['id'])) {
	$admin_controller = new AuthenticationController();
	$admin = $admin_controller->getAdminById($_SESSION['id']);
} else {
	$admin = null;
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
	<title>Admin Dashboard - Cinemax</title>
	<link href="../../public/css/app.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">AdminKit</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../dashboard/index.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="../category/category.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Category</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../movie/movie.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Movie</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../theater/theater.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Theater</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../showtime/showtime.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Show Time</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../booking/booking.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Booking</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../bookingPayment/payment.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Payment</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../payment/payment_method.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Payment Type</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="../user/user.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">User</span>
						</a>
					</li>

				</ul>

			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<?php
						if ($admin && isset($admin['id'])) {
						?>
							<div class="dropdown">
								<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="text-dark"><?php echo $_SESSION['name']; ?></span>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="../dashboard/change_password.php">Change Password</a>
									<a class="dropdown-item" href="../dashboard/logout.php">Log Out</a>
								</div>
							</div>
						<?php
						} else { 
							header('location: ../dashboard/login.php');
						}
						?>
					</ul>
				</div>
			</nav>

			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
			<script src="../../public/js/app.js"></script>
			<script src="../../public/js/myscript.js"></script>

</body>

</html>