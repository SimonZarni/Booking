<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/TheaterController.php';

$data_controller = new TheaterController();
$datas = $data_controller->getMoviesTheaters();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="col-md-2 mt-2">
        <a href="movieTheater.php" class="btn btn-success">Join movie and theater</a>
    </div>
    <div class="row mt-3">
        <?php
        $movies = [];
        foreach ($datas as $data) {
            $movieName = $data['movie'];
            $theaterName = $data['theater'];
            $theaterId = $data['id'];

            if (!isset($movies[$movieName])) {
                $movies[$movieName] = [];
            }
            $movies[$movieName][] = ['name' => $theaterName, 'id' => $theaterId];
        }
        foreach ($movies as $movie => $theaters) {
            echo "<div class='col-md-3'>";
            echo "<div class='card p-3 rounded' style='background-color: #f0f0f0; border: 1px solid #ccc;'>";
            echo "<h3 class='mb-3'>$movie</h3>";
            echo "<ul class='list-unstyled'>";
            foreach ($theaters as $theater) {
                echo "<li class='mb-2'>";
                echo $theater['name'];
                echo "<div class='btn-group mt-1'>";
                echo "<a class='btn btn-danger btn-sm mx-2' href='deleteMovieTheater.php?id=" . $theater['id'] . "' onclick='return deleteMovieTheater()'>Delete</a>";
                echo "</div>";
                echo "</li>";
            }
            echo "</ul>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>

<?php
include_once  __DIR__ . '/../../layouts/admin_footer.php';
?>