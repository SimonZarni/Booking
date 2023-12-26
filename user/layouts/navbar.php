<?php

include_once __DIR__. '/../controller/CategoryController.php';

$category_controller = new CategoryController();
$categories = $category_controller->getCategories();

?>

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
          <a class="nav-link active" aria-current="page" href="movie.php">Home</a>
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
            <select name="categories" class="form-select bg-light" required="">
              <option value="">All Categories</option>
              <?php
                foreach ($categories as $category) {
                ?>
                    <option value="<?php echo $category['id']; ?>" <?php if((isset($_POST['category']) && $_POST['category']) == $category['id']) echo 'selected'; ?>>
                        <?php echo $category['name']; ?>
                    </option>
                <?php
                }
                ?>
			      </select>
			
			<div class="input-group">
				<input type="text" class="form-control border-start-0" placeholder="Search Movie">
				<span class="input-group-btn">
					<button class="btn btn-primary bg_yell" type="button">
						<i class="fa fa-search" style="height: 28px;"></i> </button>
				</span>
			</div>
        </li>
	
		<li class="nav-item ms-3">
          <a class="nav-link button" href="register.php">SIGN UP</a>
        </li>
		
      </ul>
    </div>
  </div>
</nav>
</section>

<script>
window.onscroll = function() {myFunction()};

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

