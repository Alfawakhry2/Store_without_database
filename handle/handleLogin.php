<?php
session_start();

if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // fetching data and clean data 
    $email = trim(htmlspecialchars($_POST['email']));
    $password = $_POST['password'];

    $errors = [];
    if (empty($email) || empty($password)) {
        $errors[] = "All Fields Are Required";
    }


    $loggedUser = null;
    if (empty($errors)) {
        foreach ($_SESSION['users'] ?? [] as $user) {
            if ($user['email'] === $email) {
                if (password_verify($password, $user['password'])) {
                    $loggedUser = $user;
                }
                break;
            }
        }


        if ($loggedUser === null) {
            $_SESSION['errors'][] = "invalid email or password";
            $_SESSION['email'] = $email ; 
            header('location: ../login.php');
            exit();
        } else {
            $_SESSION['logged_user'] = [
                'username' => $loggedUser['username'],
                'email' => $loggedUser['email'],
                'phone' => $loggedUser['phone'],
                'address' => $loggedUser['address'],
            ];

            header('location:../index.php');
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['email'] = $email; // old value 
        header('location:../login.php');
        exit();
    }
    // what diff betwee 
    // - authentication ( who are you )
    // - authourization ( what is your job )

} else {
    header('location:../login.php');
    exit();
}
