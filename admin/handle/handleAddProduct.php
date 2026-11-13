<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //fetch 
    $cat = $_POST['cat'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $img = $_FILES['img'];



    $errors = [];
    $allowedExtensions = ['png' , 'jpeg' , 'jpg'];
    $extesion = pathinfo($img['name'] , PATHINFO_EXTENSION); 


    if (empty($cat) || empty($title) || empty($desc) || empty($price) || empty($quantity) || empty($img['name'])) {
        $errors[] = "All Fields Are Required";
    }elseif(!in_array($extesion , $allowedExtensions)){
        $errors[]="Allowed Extension only jpg, png, jpeg"; 
    }



    // move image 

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['cat'] = $cat;
        $_SESSION['title'] = $title;

        header('location:../view/addProduct.php');
        exit();
    }

    // check database (session exist)
    if(!isset($_SESSION['products'])){
        $_SESSION['products']= [];
    }

    $newName = uniqid() . time() . '.' . $extesion;

    $_SESSION['products'][] =[
        
        'category' => $cat , 
        'title' => $title, 
        'desc' =>$desc , 
        'price'=>$price , 
        'qty' =>$quantity , 
        'image' =>$newName,
    ];

    move_uploaded_file($img['tmp_name']  , "../upload/$newName");

    $_SESSION['success'] = ["product Addedd Success"];
    header('location:../view/addProduct.php');
    exit();

} else {
    header('location:../view/addProduct.php');
    exit();
}
