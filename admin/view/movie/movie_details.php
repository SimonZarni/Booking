<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__ . '/../../controller/MovieController.php';

$id = $_GET['id'];

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($movies as $movie) {
        if ($id == $movie['id']) {
    ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="../../public/img/<?php echo $movie['image']; ?>" class="card-img-top" alt="Movie Image">
                        <div class="card-body">
                            <p class="card-title"><strong>Movie Name:</strong> <?php echo $movie['name']; ?></p>
                            <p class="card-text"><strong>Category:</strong> <?php echo $movie['category_name']; ?></p>
                            <p class="card-text"><strong>Duration:</strong> <?php echo $movie['duration'] ?></p>
                            <p class="card-text"><strong>Release Date:</strong> <?php echo $movie['release_date']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        break;
        }
    }
    ?>

</body>

</html>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>