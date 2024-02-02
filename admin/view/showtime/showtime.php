<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/ShowTimeController.php';

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 class="mt-1"><strong>Show Time</strong></h2>
    <?php
    if(isset($_GET['status']) && $_GET['status']==true)
    {
        echo "<span class='text-success'>New Show Time has been added successfully.</span>";
    }
    ?>

    <?php
    if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
    {
        echo "<span class='text-success'>Show Time has been updated successfully.</span>";
    }
    ?>

    <div class="col-md-4 mt-3">
        <a class='btn btn-success p-2' href='addShowTime.php'>Add New Show Time</a>
    </div>
<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="showTable">
            <thead>
                <th>No</th>
                <th>Show Time</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                    foreach ($showtimes as $showtime) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $showtime['show_time'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary' href='editShowTime.php?id=".$showtime['id']."'>Edit</a>";
                    echo "<a class='btn btn-danger mx-2' href='deleteShowTime.php?id=".$showtime['id']."' onclick='return deleteShowTime()'>Delete</a>";
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

