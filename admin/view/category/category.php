<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/CategoryController.php';

$category_controller = new CategoryController();
$categories = $category_controller->getCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 class="mt-1"><strong>Category</strong></h2>
    <?php
    if(isset($_GET['status']) && $_GET['status']==true)
    {
        echo "<span class='text-success'>New Category has been added successfully.</span>";
    }
    ?>

    <?php
    if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
    {
        echo "<span class='text-success'>Category has been updated successfully.</span>";
    }
    ?>

    <div class="col-md-4 mt-3">
        <a class='btn btn-success p-2' href='addCategory.php'>Add New Category</a>
    </div>
<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="catTable">
            <thead>
                <th>No</th>
                <th>Category</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                    foreach ($categories as $category) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $category['name'] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary' href='editCategory.php?id=".$category['id']."'>Edit</a>";
                    echo "<a class='btn btn-danger mx-2' href='deleteCategory.php?id=".$category['id']."' onclick='return deleteCategory()'>Delete</a>";
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

