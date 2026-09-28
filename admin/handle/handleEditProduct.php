<?php

session_start();

if (!isset($_GET['id']) || ! array_key_exists($_GET['id'], $_SESSION['products'])) {
    header('location:../view/products.php');
    exit();
}

$id = $_GET['id'];
$product = $_SESSION['products'][$id];

if (isset($_POST['editProduct'])) {
    $cat      = $_POST['cat'];
    $title    = $_POST['title'];
    $desc     = $_POST['desc'];
    $price    = $_POST['price'];
    $qty      = $_POST['quantity'];

 $errors = [];
    if (empty($cat) || empty($title) || empty($desc) || empty($price) || empty($qty)) {
        $errors[] = "All Fields are Required";
    }
    

    // check old or new image 
    $imageName = $product['image'];
    // user uploaded new image
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['img'];
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions)) {
            $errors[] = "Allowed Extensions are png, jpg, jpeg only";
        } else {
            $newImage = uniqid() . "." . $ext;
            move_uploaded_file($img['tmp_name'], "../upload/" . $newImage);
            // delete old image
            if (!empty($product['image']) && file_exists("../upload/" . $product['image'])) {
                unlink("../upload/" . $product['image']);
            }
            $imageName = $newImage;
        }
    }

    if(!empty($errors)){
        $_SESSION['errors'] = $errors; 
        header("location:../view/editProduct.php?id=$id");
        exit();
    }

    $_SESSION['products'][$id] = [
        'category' => $cat , 
        'title' => $title,
        'desc' => $desc,
        'price' => $price,
        'qty' => $qty,
        'image' => $imageName,
    ]; 

    $_SESSION['success'][] = 'Product updated success'; 
      header('location:../view/products.php');
    exit();
}else{
    header('location:../view/products.php');
    exit();
}
