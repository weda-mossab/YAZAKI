<?php

session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}


if (!array_key_exists('id', $_GET) or !ctype_digit($_GET['id'])) {
    header('Location: ./index.php');
    exit();
}

include '../connexion.php';
include './utilities.php';

$errors = [];
if (!empty($_POST)) {

    $admin_name = checkData($_POST['admin_name']);
    $email = checkData($_POST['email']);
    $Tel = checkData($_POST['Tel']);
    $password = checkData($_POST['password']);
    $avatar = checkData($_POST['avatar']);
    $id = checkData($_POST['id']);

    // var_dump($_POST);
    // exit();

    if (empty($admin_name)) {
        $errors['admin_name'] = 'admin_name is required';
    }
    if (empty($email)) {
        $errors['email'] = 'email is required';
    }
    if (empty($Tel)) {
        $errors['Tel'] = 'Tel is required';
    }
    if (empty($password)) {
        $errors['password'] = 'password is required';
    }
    if (empty($avatar)) {
        $errors['avatar'] = 'avatar is required';
    }

    if (empty($errors)) {
        $sql = "UPDATE `admins` 
        SET 
        `admin_name`= :admin_name,
        `email` = :email, 
        `Tel` = :Tel, 
        `password` = :password,
        `avatar` = :avatar
        WHERE `id` = :id";
        $query = $con->prepare($sql);
        $query->bindValue(':admin_name', $admin_name);
        $query->bindValue(':email', $email);
        $query->bindValue(':Tel', $Tel);
        $query->bindValue(':password', $password);
        $query->bindValue(':avatar', $avatar);
        $query->bindValue(':id', $id);
        $query->execute();
        

        header('Location: Edit-admin.php');
        exit;
    }
}

$query = $con->prepare('SELECT * FROM admins WHERE id= ?');
$query->execute([$_GET['id']]);
$admin = $query->fetch();

if (!$admin) {
    header('Location: ./index.php');
    exit();
}
$page = 'Edit-admin';
$template = 'Edit-admin';
$pageTitle = 'Edit admin';
include './layout-dash.phtml';

?>