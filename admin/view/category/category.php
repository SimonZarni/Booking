<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/CategoryController.php';

$category_controller = new CategoryController();
$categories = $category_controller->getCategories();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $status = $category_controller->createCategory($name);

    if ($status) {
        echo '<script>location.href="category.php?status=' . $status . '"</script>';
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
    <h2 class="mt-1"><strong>Category</strong></h2>
    <?php
    if (isset($_GET['status']) && $_GET['status'] == true) {
        echo "<div class='alert alert-success'>New Category has been added successfully.</div>";
    }
    if (isset($_GET['updateStatus']) && $_GET['updateStatus'] == true) {
        echo "<div class='alert alert-success'>Category has been updated successfully.</div>";
    }
    if (isset($_GET['delete_success'])) {
        echo "<div class='alert alert-success'>Category deleted successfully.</div>";
    }
    if (isset($_GET['delete_status'])) {
        echo "<div class='alert alert-danger'>Category cannot be deleted as it has related movie data.</div>";
    }
    ?>

    <div class="col-md-4 mt-3">
        <a id="addCategoryBtn" class='btn btn-success p-2' href='addCategory.php'>Add New Category</a>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
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
                        echo "<a class='btn btn-primary' href='editCategory.php?id=" . $category['id'] . "'>Edit</a>";
                        echo "<a class='btn btn-danger mx-2' href='deleteCategory.php?id=" . $category['id'] . "' onclick='return deleteCategory()'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var addCategoryBtn = document.getElementById('addCategoryBtn');
        var modal = document.getElementById('myModal');
        var modalContent = document.getElementById('modalContent');

        addCategoryBtn.addEventListener('click', function(event) {
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