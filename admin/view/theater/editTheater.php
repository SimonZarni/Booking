<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/TheaterController.php';
include_once  __DIR__. '/../../controller/MovieController.php';

$id = $_GET['id'];

$theater_controller = new TheaterController();
$theater = $theater_controller->getTheaterById($id);

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $movie = $_POST['movie'];
    $updateStatus = $theater_controller->editTheater($id,$name,$movie);

    if($updateStatus){
        echo '<script>location.href="theater.php?updateStatus=' .$updateStatus. '"</script>';
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
        <h2><strong>Edit Theater</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Theater</label>
                    <input type="text" name="name" class="form-control" value="<?php if(isset($theater['name'])) echo $theater['name']; ?>">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <select name="movie" id="" class="form-select">
                        <option value="" selected disabled>Select movie</option>
                        <?php
                        foreach ($movies as $movie) {
                            $selected = ($movie['id'] == $theater['movie_id']) ? 'selected' : '';
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