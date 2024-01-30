<?php

include_once  __DIR__. '/../../controller/MovieController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $movie_controller=new MovieController();
    $result = $movie_controller->deleteMovie($id);

    if($result){
        echo "<script>location.href='movie.php'</script>";
    } 
    else {
        echo "Failed to delete movie.";
    }
}

?>