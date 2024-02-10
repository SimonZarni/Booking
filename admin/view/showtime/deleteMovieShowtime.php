<?php

include_once  __DIR__. '/../../controller/ShowtimeController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $data_controller=new ShowTimeController();
    $result = $data_controller->deleteData($id);

    if($result){
        echo "<script>location.href='movieWithShowtime.php'</script>";
    } 
    else {
        echo "Failed to delete joined movie and showtime.";
    }
}

?>