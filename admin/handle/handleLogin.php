<?php 

session_start();

define('EMAIL' , 'admin@route.com');
define('PASSWORD' , 'admin');
// const EMAIL = 'admin@route.com';

if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['errors'][] = "All Fields Required";
        $_SESSION['email'] = $email ; // old value 
        header('location:../view/login.php');
        exit();
    }
    

    if($email=== EMAIL && $password === PASSWORD){
        $_SESSION['logged_admin'] = true ; 
        header('location:../view/layout.php');
        exit();
    }else{
        $_SESSION['errors'][] = "Email or password are invalid";
        header('location:../view/login.php');
        exit();
    }

}else{
     header('location:../view/login.php');
        exit();
}
