<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/ReviewController.php';

$review_controller = new ReviewController();
$reviews = $review_controller->getReviews();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_GET['status'])) {
        echo "<div class='alert alert-success'>Review deleted successfully.</div>";
    }
    ?>
    <h2 class="mt-1"><strong>Reviews</strong></h2>
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-striped" id="reviewTable">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($reviews as $review) {
                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $review['name'] . "</td>";
                        echo "<td>" . $review['email'] . "</td>";
                        echo "<td>" . $review['subject'] . "</td>";
                        echo "<td>" . $review['message'] . "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-danger mx-2' href='deleteReview.php?id=" . $review['id'] . "' onclick='return deleteReview()'>Delete</a>";
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
include_once  __DIR__ . '/../../layouts/admin_footer.php';
?>