<?php

session_name('user_session');
session_start();
unset($_SESSION['user_id']);
session_destroy();
header('location: index.php');

?>