<?php

include_once __DIR__. '/../../layouts/admin_navbar.php';
include_once  __DIR__. '/../../controller/CategoryController.php';

$id = $_GET['id'];

$category_controller = new CategoryController();
$category = $category_controller->getCategoryById($id);

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $updateStatus = $category_controller->editCategory($id,$name);

    if($updateStatus){
        echo '<script>location.href="category.php?updateStatus=' .$updateStatus. '"</script>';
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
<div class="content">
    <div class="container-fluid">
        <h2><strong>Edit Category</strong></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-3">
                    <label for="" class="form-label">Category</label>
                    <input type="text" name="name" class="form-control" value="<?php if(isset($category['name'])) echo $category['name']; ?>">
                </div>
                <div class="mt-3">
                    <button class="btn btn-success" name="submit">Update</button>
                </div>
            </form>
    </div>
</div>

</body>

</html>

<?php
include_once __DIR__. '/../../layouts/admin_footer.php';
?>