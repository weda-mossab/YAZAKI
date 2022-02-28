<?php
//s'ilya une session ouverte il me redériger vers la page index
session_start();
if (isset($_SESSION['email'])) {
    header('Location: ../Dashboard/index.php');
    exit();
}

include '../connexion.php';

$errors = [];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if((empty($email) == true ) OR (empty($password) == true)){
        $errors[0] = 'you must fill in all the fields';
        goto show_form;
    } 

    
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {       
        $errors[0] = 'Enter a valid email';
        goto show_form;
    }
    
    $sql = "SELECT * FROM admins WHERE email = :email AND password = :password";
    $stmt = $con->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => $password
    ]);
    $admin = $stmt->fetch();

    if ($admin == false) {
        $errors[0] = 'invalid email or password';
        goto show_form;
    } else {
        if ($password == $admin['password']) {
            $_SESSION['id'] = $admin['id'];
            $_SESSION['email'] = $admin['email'];
            $_SESSION['admin_name'] = $admin['admin_name'];
            $_SESSION['avatar'] = $admin['avatar'];
            $_SESSION['Tel'] = $admin['Tel'];
            header('Location: ../Dashboard/index.php');
        } else {
            $errors[0] = 'invalid email or password';
            goto show_form;
        }
    }
}
show_form:
$namelog = 'Admin';
$template = 'login-admin';
$pageTitle = 'Admin Login page';
include './layout-log.phtml';
