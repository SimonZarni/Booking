<?php

include_once  __DIR__. '/../../controller/TheaterController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $theater_controller=new TheaterController();
    $result = $theater_controller->deleteTheater($id);

    if($result){
        echo "<script>location.href='theater.php?'</script>";
    } 
    else {
        echo "Failed to delete theater.";
    }
}

?>