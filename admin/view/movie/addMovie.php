<?php

// include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/MovieController.php';
include_once  __DIR__. '/../../controller/CategoryController.php';

$movie_controller = new MovieController();

$category_controller = new CategoryController();
$categories = $category_controller->getCategories();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $release_date = $_POST['release_date'];

    if (!empty($image)) {
        $targetDirectory = "../../uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $status = $movie_controller->createMovie($name, $image, $category, $duration, $release_date);

            if ($status) {
                echo '<script>location.href="movie.php?status=' . $status . '"</script>';
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No image uploaded.";
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
<div class="content">
    <div class="container-fluid">
        <h2><strong>Add New Movie</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Movie</label>
                    <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" class="form-control">
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
                        ?>
                            <option value="<?php echo $category['id']; ?>" <?php if((isset($_POST['category']) && $_POST['category']) == $category['id']) echo 'selected'; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Duration</label>
                    <input type="text" name="duration" value="<?php if(isset($_POST['duration'])) echo $_POST['duration']; ?>" class="form-control">
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Release Date</label>
                    <input type="date" name="release_date" value="<?php if(isset($_POST['release_date'])) echo $_POST['release_date']; ?>" class="form-control">
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

<!-- <?php
include_once __DIR__. '/../../layouts/admin_footer.php';
?> -->