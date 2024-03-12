<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/MovieController.php';
include_once  __DIR__. '/../../controller/CategoryController.php';

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

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
</head>

<body>
    <h2 class="mt-1"><strong>Movie</strong></h2>
    <?php
    if (isset($_GET['status']) && $_GET['status'] == true) {
        echo "<span class='text-success'>New Movie has been added successfully.</span>";
    }
    ?>

    <?php
    if (isset($_GET['updateStatus']) && $_GET['updateStatus'] == true) {
        echo "<span class='text-success'>Movie has been updated successfully.</span>";
    }
    ?>

    <div class="col-md-4 mt-3">
        <a id="addMovieBtn" class='btn btn-success p-2' href='addMovie.php'>Add New Movie</a>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped" id="movieTable">
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
                        echo "<td><img src='../../uploads/" . $movie['image'] . "'width='100px';height='0px'></td>";
                        echo "<td>" . $movie['category_name'] . "</td>";
                        echo "<td>" . $movie['duration'] . "</td>";
                        echo "<td>" . $movie['release_date'] . "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-success mx-2' href='movie_details.php?id=" . $movie['id'] . "'>View</a>";
                        echo "<a class='btn btn-primary' href='editMovie.php?id=" . $movie['id'] . "'>Edit</a>";
                        echo "<a class='btn btn-danger mx-2' href='deleteMovie.php?id=" . $movie['id'] . "' onclick='return deleteMovie()'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var addMovieBtn = document.getElementById('addMovieBtn');
        var modal = document.getElementById('myModal');
        var modalContent = document.getElementById('modalContent');

        addMovieBtn.addEventListener('click', function(event) {
            event.preventDefault();
            var url = this.getAttribute('href');
            loadModalContent(url);
        });

        function loadModalContent(url) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        modalContent.innerHTML = xhr.responseText;
                        modal.style.display = "block";
                    } else {
                        console.error('Error loading content');
                    }
                }
            };
            xhr.open('GET', url, true);
            xhr.send();
        }

        var closeBtn = document.getElementsByClassName("close")[0];
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>

<?php
include_once  __DIR__ . '/../../layouts/admin_footer.php';
?>