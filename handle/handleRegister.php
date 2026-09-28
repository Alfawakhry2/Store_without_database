<?php
session_start();

if (isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // fetching data and clean data 
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = $_POST['password'];
    $phone = trim(htmlspecialchars($_POST['phone']));
    $address = trim(htmlspecialchars($_POST['address']));

    // validation 
    $errors = [];
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $errors[] = "username contain only character , numbers and underscore only";
    }


    $emails = array_column($_SESSION['users'] ?? []  , 'email');
    if (empty($email)) {
        $errors[] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "incorrect email format";
    } elseif(in_array($email , $emails)){
        $errors[] = "Email Already Exist";
    }


    ## password 
    if (empty($password)) {
        $errors[] = "Password Requried";
    } elseif (strlen($password) < 3) {
        $errors[] = "Password Must be More strong";
    }


    ##phone 
    if (empty($phone)) {
        $errors[] = "phone Required";
    } elseif (!preg_match("/^01[0-9]{9}$/", $phone)) { // egy phone 
        $errors[] = "invalid phone format";
    }


    ## address 
    if (empty($address)) {
        $errors[] = "adreess Required";
    }


    if (empty($errors)) {
        //store 
        $user = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password , PASSWORD_DEFAULT),
            'phone' => $phone,
            'address' => $address
        ];

        // check session 
        if (!isset($_SESSION['users'])) {
            $_SESSION['users'] = [];
        }

        // add user to session 
        $_SESSION['users'][] = $user;
        header('location:../login.php');
        exit();
    } else {

        $_SESSION['errors'] = $errors ; 
        $_SESSION['username'] = $username ; 
        $_SESSION['email'] = $email ; 
        $_SESSION['phone'] = $phone ; 
        $_SESSION['address'] = $address ; 
        header('location:../signup.php');
        exit();
    }


    // error
} else {
    header('location:../signup.php');
    exit();
}
