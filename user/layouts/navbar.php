<?php

session_name('user_session');
session_start();
include_once __DIR__ . '/../controller/AuthenticationController.php';
include_once __DIR__ . '/../controller/CategoryController.php';

$category_controller = new CategoryController();
$categories = $category_controller->getCategories();

if (isset($_SESSION['user_id'])) {
  $user_controller = new AuthenticationController();
  $user = $user_controller->getUserById($_SESSION['user_id']);
} else {
  $user = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinemax</title>
  <link href="../public/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/css/font-awesome.min.css" rel="stylesheet">
  <link href="../public/css/global.css" rel="stylesheet">
  <link href="../public/css/index.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>

<body>
  <section id="header">
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">SIGN UP</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" href="register.php"></button>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky">
      <div class="container-fluid">
        <a class="navbar-brand fs-4 p-0 fw-bold text-white text-uppercase" href="index.html"><i class="fa fa-video-camera me-1 col_light fs-1 align-middle"></i> Entertain Pro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mb-0">

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="checkBooking.php">Booking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="payment.php">Payment</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>

          </ul>
          <ul class="navbar-nav mb-0 ms-auto">

            <li class="nav-item">
              <form action="displayMovies.php" method="post">
                <select name="category" class="form-select bg-light col-md-6">
                  <option value="">All Categories</option>
                  <?php
                  foreach ($categories as $category) {
                    $selected = "";
                    if (isset($_POST['category']) && $_POST['category'] == $category['id']) {
                      $selected = 'selected';
                    }
                  ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>>
                      <?php echo $category['name']; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
                <button class="btn btn-primary bg_yell" type="submit">
                  <i class="fa fa-search" style="height: 28px;"></i>
                </button>
              </form>

              <form action="searchMovies.php" method="get">
                <div class="input-group">
                  <input type="text" name="keyword" class="form-control border-start-0" placeholder="Search Movie">
                  <span class="input-group-btn">
                    <button class="btn btn-primary bg_yell" type="submit">
                      <i class="fa fa-search" style="height: 28px;"></i>
                    </button>
                  </span>
                </div>
              </form>
            </li>

            <?php
            if ($user && isset($user['id'])) {
            ?>
              <li class="nav-item ms-3 dropdown">
                <button class="nav-link dropdown-toggle button" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php if (isset($_SESSION['user_name'])) echo $_SESSION['user_name']; ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="change_password.php">Change Password</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            <?php
            } else {
            ?>
              <li class="nav-item ms-3 dropdown">
                <button class="nav-link dropdown-toggle button" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  Guest
                </button>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="login.php">Sign In</a></li>
                </ul>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </section>

  <script src="../public/js/bootstrap.bundle.min.js"></script>
  <script src="../public/js/app.js"></script>
  <script src="../public/js/myscript.js"></script>

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