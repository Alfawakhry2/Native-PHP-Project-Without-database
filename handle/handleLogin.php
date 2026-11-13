<?php 

session_start(); 

if(isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['login'])){
    // fetch , clean and escape
    

    $email = trim(htmlspecialchars($_POST['email']));
    $password = $_POST['password'];


    //validate 
    $errors = [];
    if(empty($email) || empty($password)){
        $errors[] = "All Fields Are Required"; 
    }

    $loggedUser = null ; 
    if(empty($errors)){
        foreach($_SESSION['user'] ?? [] as $user){
            if($user['email'] === $email){
                if(password_verify($password , $user['password'])){
                    $loggedUser = $user ;
                }
                break;
            }
        }

       
        if($loggedUser === null){
            $_SESSION['errors'] = ["invalid Email or password"];
            $_SESSION['email'] = $email;

            header('location:../login.php');
            exit();
        }else{
            $_SESSION['logged_user'] = [
                'username' => $loggedUser['username'],  
                'email' => $loggedUser['email'],  
                'phone' => $loggedUser['phone'],  
                'address' => $loggedUser['address']
            ];

            header('location:../shop.php');
            exit();
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location:../login.php');
        exit();
    }

}else{
    header('location:../login.php');
    exit();
}