<?php

session_start();

if(!isset($_GET['id']) || !array_key_exists($_GET['id'], $_SESSION['categories'])){
    $_SESSION['errors'] = ['category not found'];
    header('location:listCategory.php');
    exit();
}


$id = $_GET['id'] ; 


unset($_SESSION['categories'][$id]);
$_SESSION['success'] = ['category deleete sucess'];
header('location:listCategory.php');
exit();




