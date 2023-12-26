<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/MovieController.php';
include_once  __DIR__. '/../../controller/CategoryController.php';

$id = $_GET['id'];

$movie_controller = new MovieController();
$movie = $movie_controller->getMovieById($id);

$category_controller = new CategoryController();
$categories = $category_controller->getCategories();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $release_date = $_POST['release_date'];
    $updateStatus = $movie_controller->editMovie($id,$name,$image,$category,$duration,$release_date);

    if($updateStatus){
        echo '<script>location.href="movie.php?updateStatus=' . $updateStatus . '"</script>';
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
        <h2><strong>Edit Movie</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <input type="text" name="name" value="<?php echo $movie['name']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" name="image" value="<?php if(isset($_POST['image'])) echo $_POST['image']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category" id="" class="form-select">
                        <option value="" selected disabled>Select category</option>
                        <?php
                        foreach ($categories as $category) {
                            $selected = ($category['id'] == $movie['category_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Duration</label>
                    <input type="text" name="duration" value="<?php echo $movie['duration']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Release Date</label>
                    <input type="date" name="release_date" value="<?php echo $movie['release_date']; ?>" class="form-control">
                </div>

                <div class="mt-3">
                    <button class="btn btn-success" type="submit" name="submit">Update</button>
                </div>
            </form>
    </div>
</div>
</body>

</html>

<?php
include_once __DIR__. '/../../layouts/admin_footer.php';
?>