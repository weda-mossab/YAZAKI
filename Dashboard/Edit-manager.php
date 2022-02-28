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

$errors1 = [];

if (!empty($_POST)) {
    $manager_name = checkData($_POST['manager_name']);
    $email_manager = checkData($_POST['email_manager']);
    $Tel_manager = checkData($_POST['Tel_manager']);
    $password_manager = checkData($_POST['password_manager']);
    $avatar_manager=$_FILES["avatar_manager"]["name"];
    $department = checkData($_POST['department']);
    $id_manager = checkData($_GET['id']);

    if (empty($manager_name)) {
        $errors1['manager_name'] = 'Full Name is required';
    }
    if (empty($email_manager)) {
        $errors1['email_manager'] = 'email_manager is required';
    }
    if(filter_var($email_manager, FILTER_VALIDATE_EMAIL) == false){
        $errors1['email_manager'] = 'please enter an email_manager valid';
    }
    if (empty($Tel_manager)) {
        $errors1['Tel_manager'] = 'Phone Number is required';
    }
    if (empty($password_manager)) {
        $errors1['password_manager'] = 'password_manager is required';
    }
   
    if (empty($avatar_manager)) {
      $errors1['avatar_manager'] = 'avatar_manager is required';
    }

    if (empty($errors)) {
        $sql = "UPDATE managers 
                SET
                    manager_name = :manager_name,
                    email_manager = :email_manager,
                    Tel_manager = :Tel_manager,
                    password_manager = :password_manager,
                    avatar_manager = :avatar_manager
                WHERE id_manager = :id_manager";
        $query = $con->prepare($sql);
        $query->bindValue(':manager_name', $manager_name);
        $query->bindValue(':email_manager', $email_manager);
        $query->bindValue(':Tel_manager', $Tel_manager);
        $query->bindValue(':password_manager', $password_manager);
        $query->bindValue(':avatar_manager', $avatar_manager);
        $query->bindValue(':id_manager', $id_manager);
        $query->execute();

        header('Location: Edit-manager.php');
        exit();
    }
}

   


$query = $con->prepare('SELECT * FROM managers WHERE id_manager= ?');
$query->execute([$_GET['id']]);
$manager = $query->fetch();

if (!$manager) {
    header('Location: ./index.php');
    exit();
}
$page = 'Edit-manager';
$template = 'Edit-manager';
$pageTitle = 'Edit manager';
include './layout-dash.phtml';

?>