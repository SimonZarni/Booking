<?php

include_once __DIR__ . '/../layouts/navbar.php';
include_once  __DIR__ . '/../controller/MovieController.php';

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
                <div class="col-md-6">
                    <div class="media">
                        <img src="../../admin/uploads/<?php echo $movie['image']; ?>" class="align-self-start mr-3" alt="Movie Image" style="max-width: 300px;">
                        <div class="media-body">
                            <h5 class="mt-0"><strong>Movie Name:</strong> <?php echo $movie['name']; ?></h5>
                            <p><strong>Category:</strong> <?php echo $movie['category_name']; ?></p>
                            <p><strong>Duration:</strong> <?php echo $movie['duration'] ?></p>
                            <p><strong>Release Date:</strong> <?php echo $movie['release_date']; ?></p>
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
include_once __DIR__ . '/../layouts/footer.php';
?>