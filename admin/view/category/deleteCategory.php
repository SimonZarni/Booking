<?php

include_once  __DIR__. '/../../controller/CategoryController.php';
include_once  __DIR__. '/../../controller/MovieController.php';

// if(isset($_GET['id'])){
//     $id = $_GET['id'];

//     $category_controller=new CategoryController();
//     $result = $category_controller->deleteCategory($id);

//     if($result){
//         echo "<script>location.href='category.php'</script>";
//     } 
//     else {
//         echo "Failed to delete category.";
//     }
// }

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$category_controller = new CategoryController();

$movie_controller = new MovieController();
$movies = $movie_controller->getMovies();

$movie_cat = false;
foreach($movies as $movie){
    if($movie['category_id'] == $id){
        $movie_cat = true;
        break; 
    }
}

if(!$movie_cat){
    $status = $category_controller->deleteCategory($id);    
    header('location: category.php?delete_success=delete');
} else {
    header('location: category.php?delete_status=fail');    
}

?>