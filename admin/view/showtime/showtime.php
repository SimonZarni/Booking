<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/ShowTimeController.php';

$showtime_controller = new ShowTimeController();
$showtimes = $showtime_controller->getShowTimes();

if(isset($_POST['submit'])){
    $showtime = $_POST['name'];
    $status = $showtime_controller->createShowTime($showtime);

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
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .close1, .close2, .close3 {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2 class="mt-1"><strong>Show Time</strong></h2>
    <?php
    if (isset($_GET['status']) && $_GET['status'] == true) {
        echo "<span class='text-success'>New Show Time has been added successfully.</span>";
    }
    ?>

    <?php
    if (isset($_GET['updateStatus']) && $_GET['updateStatus'] == true) {
        echo "<span class='text-success'>Show Time has been updated successfully.</span>";
    }
    ?>

    <div class="col-md-6 mt-3">
        <!-- <a class='btn btn-success p-2' href='addShowTime.php'>Add New Showtime</a> -->
        <a id="addShowtimeBtn" class='btn btn-success p-2' href='addShowTime.php'>Add New Showtime</a>
        <div id="myModal1" class="modal">
            <div class="modal-content">
                <span class="close1">&times;</span>
                <div id="modalContent1"></div>
            </div>
        </div>
        <a class='btn btn-primary p-2 mx-2' href="movieShowtime.php">Join with movie</a>
        <a class='btn btn-danger p-2' href="moviewithShowtime.php">Showtimes and movies</a>
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
                        echo "<a class='btn btn-primary' href='editShowTime.php?id=" . $showtime['id'] . "'>Edit</a>";
                        echo "<a class='btn btn-danger mx-2' href='deleteShowTime.php?id=" . $showtime['id'] . "' onclick='return deleteShowTime()'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var addShowtimeBtn = document.getElementById('addShowtimeBtn');
        var modal = document.getElementById('myModal1');
        var modalContent = document.getElementById('modalContent1');

        addShowtimeBtn.addEventListener('click', function(event) {
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

        var closeBtn = document.getElementsByClassName("close1")[0];
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