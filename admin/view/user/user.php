<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/UserController.php';

$user_controller = new UserController();
$users = $user_controller->getUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 class="mt-1"><strong>User</strong></h2>
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
    
<div class="row mt-3">
    <div class="col-md-12">
        <table class="table table-striped" id="userTable">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
            </thead>
            <tbody>
                <?php
                $count = 1;
                    foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
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

