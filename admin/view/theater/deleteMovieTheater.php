<?php

include_once  __DIR__. '/../../controller/TheaterController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $data_controller=new TheaterController();
    $result = $data_controller->deleteData($id);

    if($result){
        echo "<script>location.href='movieWithTheater.php'</script>";
    } 
    else {
        echo "Failed to delete joined movie and theater.";
    }
}

?>