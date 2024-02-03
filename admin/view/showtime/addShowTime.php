<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/ShowTimeController.php';
include_once  __DIR__. '/../../controller/MovieController.php';

$showtime_controller = new ShowTimeController();

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

if(isset($_POST['submit'])){
    $showtime = $_POST['name'];
    $movie = $_POST['movie'];
    $status = $showtime_controller->createShowTime($showtime,$movie);

    if($status){
        echo '<script>location.href="showtime.php?status=' .$status. '"</script>';
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
<div class="content">
    <div class="container-fluid">
        <h2><strong>Add New Show Time</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Show Time</label>
                    <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <select name="movie" id="" class="form-select">
                        <option value="" selected disabled>Select movie</option>
                        <?php
                        foreach ($movies as $movie) {
                        ?>
                            <option value="<?php echo $movie['id']; ?>" <?php if((isset($_POST['movie']) && $_POST['movie']) == $movie['id']) echo 'selected'; ?>>
                                <?php echo $movie['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit" name="submit">Add</button>
                </div>
            </form>
    </div>
</div>

<script src="../../public/js/app.js"></script>

</body>

</html>

<?php
include_once  __DIR__. '/../../layouts/admin_footer.php';
?>