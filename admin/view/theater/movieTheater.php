<?php

// include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/TheaterController.php';
include_once __DIR__ . '/../../controller/MovieController.php';

$theater_controller = new TheaterController();
$theaters = $theater_controller->getTheaters();

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

if (isset($_POST['submit'])) {
    $movie = $_POST['movie'];
    $theater = $_POST['theater'];
    $status = $theater_controller->joinMovieTheater($movie, $theater);

    if ($status) {
        echo '<script>location.href="movieWithTheater.php"</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../public/css/app.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <label for="" class="form-label">Theater</label>
                <select name="theater" id="" class="form-select">
                    <option value="" selected disabled>Select theater</option>
                    <?php
                    foreach ($theaters as $theater) {
                    ?>
                        <option value="<?php echo $theater['id']; ?>" <?php if ((isset($_POST['theater']) && $_POST['theater']) == $theater['id']) echo 'selected'; ?>>
                            <?php echo $theater['name']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="my-3 d-flex">
                <a href="theater.php" class="btn btn-primary mx-2">Back</a>
                <button class="btn btn-success" type="submit" name="submit">Join</button>
            </div>
        </form>
    </div>
</body>

</html>

<!-- <?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?> -->