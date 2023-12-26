<?php

include_once  __DIR__. '/../../controller/ShowTimeController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $showtime_controller=new ShowTimeController();
    $result = $showtime_controller->deleteShowTime($id);

    if($result){
        echo "<script>location.href='showtime.php?'</script>";
    } 
    else {
        echo "Failed to delete showtime.";
    }
}

?>