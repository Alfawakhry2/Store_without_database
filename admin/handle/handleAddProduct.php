<?php 
session_start(); 
if(isset($_POST['addProduct']) && $_SERVER['REQUEST_METHOD'] ==='POST'){
    // fetch data and validate 
    $cat = $_POST['cat']; 
    $title = $_POST['title']; 
    $desc = $_POST['desc']; 
    $price = $_POST['price']; 
    $quantity = $_POST['quantity'];
    $img = $_FILES['img']; 

    

    $errors = [];
    $allowedExtensions = ['png' , 'jpeg' , 'jpg'];
    $extension = pathinfo($img['name'] , PATHINFO_EXTENSION);

    if(empty($cat) || empty($title) || empty($desc) ||empty($price) ||empty($quantity) ||empty($img['name'])){
        $errors []= 'All fields are required';
    }elseif(!in_array($extension , $allowedExtensions)){
        $errors [] = "Allowed extensions are png,jpg , jpeg"; 
    }


    if(!empty($errors)){
        $_SESSION['errors'] = $errors ;
        $_SESSION['cat'] = $_POST['cat'];
        $_SESSION['title'] = $_POST['title'];
        header('location:../view/addProduct.php');
        exit();
    }

    if(!isset($_SESSION['products'])){
        $_SESSION['products'] = []; 
    }

    $newImage = uniqid() . time() . '.' . $extension ;
    $_SESSION['products'][]= [
        'category' => $cat , 
        'title' => $title , 
        'desc' => $desc , 
        'price' => $price , 
        'qty' => $quantity , 
        'image' => $newImage,
    ];

    move_uploaded_file($img['tmp_name'] , "../upload/$newImage");
    $_SESSION['success'][] = "Product Addedd Successfully";
    header('location:../view/addProduct.php');
    exit();

}else{
    header('location:../view/addProduct.php');
    exit();
}
