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
        <div class="container mt-1 p-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="media">
                        <img src="../../admin/uploads/<?php echo $movie['image']; ?>" class="align-self-start mr-3" alt="Movie Image" style="max-width: 300px;">
                    </div>
                </div>
                <div class="col-md-8">
                    <p><strong><?php echo $movie['name']; ?></strong></p>
                    <p> <?php echo $movie['plot']; ?></p>
                    <p><strong>Category:</strong> <?php echo $movie['category_name']; ?></p>
                    <p><strong>Duration:</strong> <?php echo $movie['duration'] ?></p>
                    <p><strong>Release Date:</strong> <?php echo $movie['release_date']; ?></p>
                    <p><strong>Country:</strong> <?php echo $movie['country']; ?></p>
                    <p><strong>Production:</strong> <?php echo $movie['production']; ?></p>
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