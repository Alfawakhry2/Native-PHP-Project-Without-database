<?php

session_start();
if(!isset($_SESSION['logged_admin']) && !$_SESSION['logged_admin'] === true){
    header('location:login.php');
    exit();
}

include "../view/header.php";
include "../view/sidebar.php";
include "../view/body.php";
include "../view/navbar.php";
include "../view/footer.php";

