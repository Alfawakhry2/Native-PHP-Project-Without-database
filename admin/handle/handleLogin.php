<?php

session_start();

define('EMAIL', 'admin@route.com');
define('PASSWORD', password_hash('admin' , PASSWORD_DEFAULT));

if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    //fetch data 
    $email = $_POST['email'];
    $password = $_POST['password'];

    // validation 
    if (empty($email) || empty($password)) {
        $_SESSION['errors'] = ['All Fields Are REquired'];
        $_SESSION['email'] = $email;
        header('location:../view/login.php');
        exit();
    }

    // check (data is valid or no) and redirect
    if ($email === EMAIL && password_verify($password, PASSWORD)) {
        $_SESSION['logged_admin'] = true;
        header('location:../view/layout.php');
        exit();
    }
} else {
    header('location:../view/login.php');
    exit();
}
