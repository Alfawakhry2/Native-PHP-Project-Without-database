<?php 

session_start();


unset($_SESSION['logged_admin']);


header('location:../view/login.php');
exit();