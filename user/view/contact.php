<?php
include_once __DIR__ . '/../layouts/navbar.php';
include_once __DIR__ . '/../controller/ContactController.php';

$contact_controller = new ContactController();

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$status = $contact_controller->submitForm($name, $email, $subject, $message);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Entertain Pro</title>
</head>

<body>
	<?php
	if (isset($_GET['status'])) {
		echo "<span class='text-success'>Thank You For Contacting Us!</span>";
	}
	?>
	<section id="center" class="center_o pt-5">
		<div class="container">
			<div class="row center_o1 text-center">
				<div class="col-md-12">
					<h2>CONTACT US</h2>
				</div>
			</div>
		</div>
	</section>

	<section id="contact" class="p_3 bg-light">
		<div class="container">
			<div class="row contact1">
				<div class="col-md-8">
					<form action="" method="post">
						<div class="contact1l">
							<h3>CONTACT US</h3>
							<hr class="line">
							<div class="blog1ld3 row mt-4">
								<div class="col-md-6">
									<div class="blog1ld3l">
										<input class="form-control" placeholder="Name" type="text" name="name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="blog1ld3l">
										<input class="form-control" placeholder="Email" type="email" name="email">
									</div>
								</div>
							</div>
							<div class="blog1ld3 row">
								<div class="col-md-12">
									<div class="blog1ld3l">
										<input class="form-control mt-3" placeholder="Subject" type="text" name="subject">
									</div>
								</div>
							</div>
							<div class="blog1ld3 row">
								<div class="col-md-12">
									<div class="blog1ld3l">
										<textarea placeholder="Message" class="form-control form_text mt-3" name="message"></textarea>
										<button class="button_1 mt-3" name="submit">Submit</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<div class="contact1r bg_red p-4 rounded-3 pt-5 pb-5 mt-4">
						<h6 class="text-white"> <i class="fa fa-facebook me-1 align-middle"></i> Facebook Account</h6>
						<h6 class="text-white mt-3"> <i class="fa fa-twitter me-1 align-middle"></i> Twitter Account</h6>
						<h6 class="text-white mt-3"> <i class="fa fa-vimeo me-1 align-middle"></i> Vimeo Account</h6>
						<h6 class="text-white mt-3"> <i class="fa fa-instagram me-1 align-middle"></i> Instagram Account</h6>
						<h6 class="text-white mt-3 mb-0"> <i class="fa fa-youtube-play me-1 align-middle"></i> Youtube Account</h6>
						<h6 class="text-white mt-3"> <i class="fa fa-linkedin me-1 align-middle"></i> Linkedin Account</h6>
						<h6 class="text-white mt-3 mb-0"> <i class="fa fa-google me-1 align-middle"></i> Google Account</h6>
					</div>
				</div>
			</div>
			<div class="row contact2 mt-4">
				<div class="col-md-4">
					<div class="contact2i text-center bg-white shadow_box p-4">
						<span class="d-inline-block bg_red text-white fs-2 rounded"><i class="fa fa-phone"></i></span>
						<h4 class="mt-3">Contact</h4>
						<h6 class="text-muted">+(000) 345 67 89</h6>
						<h6 class="mb-0 text-muted">+(000) 345 67 89</h6>
					</div>
				</div>
				<div class="col-md-4">
					<div class="contact2i text-center bg-white shadow_box p-4">
						<span class="d-inline-block bg_red text-white fs-2 rounded"><i class="fa fa-map"></i></span>
						<h4 class="mt-3">Location</h4>
						<h6 class="text-muted">302 - Sem Nagar , India</h6>
						<h6 class="mb-0 text-muted">Omez City 125 , India</h6>
					</div>
				</div>
				<div class="col-md-4">
					<div class="contact2i text-center bg-white shadow_box p-4">
						<span class="d-inline-block bg_red text-white fs-2 rounded"><i class="fa fa-envelope"></i></span>
						<h4 class="mt-3">Email</h4>
						<h6 class="text-muted">info@gmail.com</h6>
						<h6 class="mb-0 text-muted">info@gmail.com</h6>
					</div>
				</div>
			</div>
			<div class="contact3 row mt-4">
				<div class="col-md-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3700.801707877006!2d96.09006677473924!3d21.94217325578194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb6d689c4f2a49%3A0x7dc5ef273e2c02be!2sMingalar%20Mandalay!5e0!3m2!1sen!2smm!4v1710342604690!5m2!1sen!2smm" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</section>

	<section id="subs" class="pt-5 pb-5 bg_red">
		<div class="container-xl">
			<div class="row subs_1">
				<div class="col-md-4">
					<div class="subs_1l">
						<h4 class="text-white mb-0 mt-2">GET UPDATE SIGN UP NOW !</h4>
					</div>
				</div>
				<div class="col-md-8">
					<div class="subs_1r">
						<div class="input-group">
							<input type="text" class="form-control bg-transparent" placeholder="Enter Your Email">
							<span class="input-group-btn">
								<button class="btn btn-primary bg-white col_red" type="button">
									Submit </button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
		window.onscroll = function() {
			myFunction()
		};

		var navbar_sticky = document.getElementById("navbar_sticky");
		var sticky = navbar_sticky.offsetTop;
		var navbar_height = document.querySelector('.navbar').offsetHeight;

		function myFunction() {
			if (window.pageYOffset >= sticky + navbar_height) {
				navbar_sticky.classList.add("sticky")
				document.body.style.paddingTop = navbar_height + 'px';
			} else {
				navbar_sticky.classList.remove("sticky");
				document.body.style.paddingTop = '0'
			}
		}
	</script>

</body>

</html>

<?php
include_once __DIR__ . '/../layouts/footer.php';
?>