<?php

session_start();


if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // check in category session that id already exist or no 
    if (array_key_exists($id, $_SESSION['products'])) {
        $product = $_SESSION['products'][$id];
    } else {
        $_SESSION['errors'] = ['Product Not Exist'];
        header('location:products.php');
        exit();
    }
} else {
    header('location:products.php');
    exit();
}



if (isset($_POST['editProduct'])) {
    //fetch 
    $cat = $_POST['cat'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $img = $_FILES['img'];

    $errors = [];

    if (empty($cat) || empty($title) || empty($desc) || empty($price) || empty($quantity)) {
        $errors[] = "All Fields Are Required";
    }


    // check new image or no 

    $imageName = $product['image'];

    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['img'];
        $allowedExtensions = ['png', 'jpeg', 'jpg'];
        $extesion = pathinfo($img['name'], PATHINFO_EXTENSION);

        if (!in_array($extesion, $allowedExtensions)) {
            $errors[] = "Allowed Extension only jpg, png, jpeg";
        } else {
            $newImage = uniqid() . time() . '.' . $extesion;
            move_uploaded_file($img['tmp_name'], "../upload/" . $newImage);

            //delete old image 
            if (!empty($product['image']) && file_exists("../upload/" . $product['image'])) {
                unlink("../upload/" . $product['image']);
            }

            $imageName = $newImage;
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('location:../view/editProduct.php?id=' . $id);
        exit();
    }


    $_SESSION['products'][$id] = [
        'category' => $cat,
        'title' => $title,
        'desc' => $desc,
        'price' => $price,
        'qty' => $quantity,
        'image' => $imageName
    ];


    $_SESSION['success'] = ['product updated successfuly'];
    header('location:../view/editProduct.php?id=' . $id);
    exit();
}else{
    header('location:../view/products.php');
    exit();
}
