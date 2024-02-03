<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/ShowTimeController.php';
include_once  __DIR__. '/../../controller/MovieController.php';

$id = $_GET['id'];

$showtime_controller = new ShowTimeController();
$showtime = $showtime_controller->getShowTimeById($id);

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $movie = $_POST['movie'];
    $updateStatus = $showtime_controller->editShowTime($id,$name,$movie);

    if($updateStatus){
        echo '<script>location.href="showtime.php?updateStatus=' .$updateStatus. '"</script>';
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
        <h2><strong>Edit Show Time</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Show Time</label>
                    <input type="text" name="name" class="form-control" value="<?php if(isset($showtime['show_time'])) echo $showtime['show_time']; ?>">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <select name="movie" id="" class="form-select">
                        <option value="" selected disabled>Select movie</option>
                        <?php
                        foreach ($movies as $movie) {
                            $selected = ($movie['id'] == $showtime['movie_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $movie['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $movie['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="mt-3">
                    <button class = "btn btn-success" name = "submit">Update</button>
                </div>
            </form>
    </div>
</div>

</body>

</html>

<?php
include_once __DIR__. '/../../layouts/admin_footer.php';
?>