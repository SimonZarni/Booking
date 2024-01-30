<?php

include_once  __DIR__. '/../../controller/CategoryController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $category_controller=new CategoryController();
    $result = $category_controller->deleteCategory($id);

    if($result){
        echo "<script>location.href='category.php'</script>";
    } 
    else {
        echo "Failed to delete category.";
    }
}

?>