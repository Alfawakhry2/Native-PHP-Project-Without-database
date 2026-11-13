<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // fetch , clean data and escaping 

    $username = trim(htmlspecialchars($_POST['username'])); // clean and escape 
    $email = trim(htmlspecialchars($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $phone = trim(htmlspecialchars($_POST['phone']));
    $address = trim(htmlspecialchars($_POST['address']));

    // validate 
    $errors = [];

    //username
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $errors[] = "username should contain lowercase , uppercase and underscore only";
    }

    // email (should unique)
    // check dublication 
 
    $emails = array_column($_SESSION['user'] ?? [] , 'email'); // all email (in arrary)
    
    if (empty($email)) {
        $errors[] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email format";
    }elseif(in_array($email , $emails)){
        $errors[] = "Email Already Exist ,choose another one ";
    }

    //password 
    if (empty($password)) {
        $errors[] = "password is required";
    } elseif (strlen($password) < 3) {
        $errors[] = "password Must be strong";
    }

    // phone 
    if (empty($phone)) {
        $errors[] = "phone is required";
    }elseif(!preg_match("/^01[0125][0-9]{8}$/" , $phone)){//total = 11 digit
        $errors[] = "invalid phone format";
    }

    //address 
    if (empty($address)) {
        $errors[] = "address is required";
    }

    //store
    if(empty($errors)){
        $user = [
            'username' => $username , 
            'email'=> $email , 
            'password' => password_hash($password , PASSWORD_DEFAULT),
            'phone' => $phone , 
            'address' => $address
        ];

        // two problem 
        // 1- check if database already exist or no (session)
        // 2- append user to users 

        // check database(session)
        if(!isset($_SESSION['user'])){
            $_SESSION['user'] = [];
        }
        //store user 
        $_SESSION['user'][] = $user ;


        header('location:../login.php');
        exit();

    }else{
        //return error in session 
        $_SESSION['errors'] = $errors ;
        // old values 
        $_SESSION['username'] = $username ;
        $_SESSION['email'] = $email ;
        $_SESSION['phone'] = $phone ;
        $_SESSION['address'] = $address ;

        header('location:../signup.php');
        exit();
    }


    echo $username;
} else {
    header('location:../signup.php');
    exit();
}
