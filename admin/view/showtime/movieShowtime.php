<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/MovieController.php';
include_once __DIR__ . '/../../controller/ShowTimeController.php';

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

if (isset($_POST['submit'])) {
    $movie = $_POST['movie'];
    $showtime = $_POST['showtime'];
    $status = $showtime_controller->joinMovieShowtime($movie, $showtime);

    if ($status) {
        echo '<script>location.href="movieWithShowtime.php"</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <form action="" method="post">
            <div class="my-3">
                <label for="" class="form-label">Movie</label>
                <select name="movie" id="" class="form-select">
                    <option value="" selected disabled>Select movie</option>
                    <?php
                    foreach ($movies as $movie) {
                    ?>
                        <option value="<?php echo $movie['id']; ?>" <?php if ((isset($_POST['movie']) && $_POST['movie']) == $movie['id']) echo 'selected'; ?>>
                            <?php echo $movie['name']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="my-3">
                <label for="" class="form-label">Showtime</label>
                <select name="showtime" id="" class="form-select">
                    <option value="" selected disabled>Select showtime</option>
                    <?php
                    foreach ($showtimes as $showtime) {
                    ?>
                        <option value="<?php echo $showtime['id']; ?>" <?php if ((isset($_POST['showtime']) && $_POST['showtime']) == $showtime['id']) echo 'selected'; ?>>
                            <?php echo $showtime['show_time']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="my-3 d-flex">
                <a href="showtime.php" class="btn btn-primary mx-2">Back</a>
                <button class="btn btn-success" type="submit" name="submit">Join</button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>