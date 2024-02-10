<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/TheaterController.php';

$theater_controller = new TheaterController();
$theaters = $theater_controller->getTheaters();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 class="mt-1"><strong>Theater</strong></h2>
    <?php
    if(isset($_GET['status']) && $_GET['status']==true)
    {
        echo "<span class='text-success'>New Theater has been added successfully.</span>";
    }
    ?>

    <?php
    if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
    {
        echo "<span class='text-success'>Theater has been updated successfully.</span>";
    }
    ?>

    <div class="col-md-6 mt-3 d-flex">
        <a class='btn btn-success p-2' href='addTheater.php'>Add New Theater</a>
        <a class='btn btn-primary p-2 mx-2' href="movieTheater.php">Join with movie</a>
        <a class='btn btn-danger p-2 mx-2' href="movieWithTheater.php">Theaters and movies</a>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped" id="theaterTable">
                <thead>
                    <th>No</th>
                    <th>Theater</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                        foreach ($theaters as $theater) {
                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $theater['name'] . "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-primary' href='editTheater.php?id=".$theater['id']."'>Edit</a>";
                        echo "<a class='btn btn-danger mx-2' href='deleteTheater.php?id=".$theater['id']."' onclick='return deleteTheater()'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

<?php
include_once  __DIR__. '/../../layouts/admin_footer.php';
?>



