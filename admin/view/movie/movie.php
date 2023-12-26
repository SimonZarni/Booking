<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/MovieController.php';

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
<h2 class="mt-1"><strong>Movie</strong></h2>
    <?php
    if(isset($_GET['status']) && $_GET['status']==true)
    {
        echo "<span class='text-success'>New Movie has been added successfully.</span>";
    }
    ?>

    <?php
    if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
    {
        echo "<span class='text-success'>Movie has been updated successfully.</span>";
    }
    ?>

    <div class="col-md-4 mt-3">
        <a class='btn btn-success p-2' href='addMovie.php?'>Add New Movie</a>
    </div>
<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="mytable">
            <thead>
                <th>No</th>
                <th>Movie</th>
                <th>Image</th>
                <th>Category</th>
                <th>Duration</th>
                <th>Release Date</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                    foreach ($movies as $movie) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $movie['name'] . "</td>";
                    echo "<td><img src='../../public/img/" . $movie['image'] . "'width='100px';height='0px'></td>";
                    echo "<td>" . $movie['category_name'] . "</td>";
                    echo "<td>" . $movie['duration'] . "</td>";
                    echo "<td>" . $movie['release_date'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary' href='editMovie.php?id=".$movie['id']."'>Edit</a>";
                    echo "<a class='btn btn-danger mx-2' href='deleteMovie.php?id=".$movie['id']."' onclick='return deleteMovie()'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../../public/js/app.js"></script>
<script src="../../public/js/myscript.js"></script>

</body>

</html>

<?php
include_once  __DIR__. '/../../layouts/admin_footer.php';
?>