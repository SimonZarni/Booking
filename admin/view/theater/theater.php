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

    <div class="col-md-4 mt-3">
        <a class='btn btn-success p-2' href='addTheater.php?'>Add New Theater</a>
    </div>
<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="mytable">
            <thead>
                <th>No</th>
                <th>Category</th>
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

<script src="../../public/js/app.js"></script>
<script src="../../public/js/myscript.js"></script>

</body>

</html>

<?php
include_once  __DIR__. '/../../layouts/admin_footer.php';
?>



