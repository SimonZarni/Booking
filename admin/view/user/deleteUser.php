<?php

include_once  __DIR__. '/../../controller/UserController.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $user_controller=new UserController();
    $result = $user_controller->deleteUser($id);

    if($result){
        echo "<script>location.href='user.php'</script>";
    } 
    else {
        echo "Failed to delete user.";
    }
}

?>