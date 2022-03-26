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

    $user_name = checkData($_POST['user_name']);
    $email_user = checkData($_POST['email_user']);
    $Tel_user = checkData($_POST['Tel_user']);
    $password_user = checkData($_POST['password_user']);
    $avatar_user=$_FILES["avatar_user"]["name"];
    $department = checkData($_POST['department']);
    $id_user = checkData($_GET['id']);

    // var_dump($_POST);
    // exit();

    if (empty($user_name)) {
        $errors['user_name'] = 'user_name is required';
    }
    if (empty($email_user)) {
        $errors['email_user'] = 'email_user is required';
    }
    if(filter_var($email_user,  FILTER_VALIDATE_EMAIL) == false){
        $errors['email_user'] = 'please enter an email valid_user';
    }
    if (empty($Tel_user)) {
        $errors['Tel_user'] = 'Tel_user is required';
    }
    if((strlen($Tel_user)<8)){
        $errors['Tel_user'] = 'Phone Number should countaint 8 numbers';
    }
    if (empty($password_user)) {
        $errors['password_user'] = 'password_user is required';
    }
    if (empty($department)) {
        $errors1['department'] = 'department is required';
    }
    if((strlen($password_user)<6)){
        $errors['password_user'] = 'weak password';
    }
    if (empty($avatar_user)) {
        $errors['avatar_user'] = 'avatar_user is required';
    }

    if (empty($errors)) {
        $sql = "UPDATE users
            SET 
                user_name= :user_name,
                email_user = :email_user, 
                Tel_user = :Tel_user, 
                department = :department,
                password_user = :password_user,
                avatar_user = :avatar_user
            WHERE id_user = :id_user";
        $query = $con->prepare($sql);
        $query->bindValue(':user_name', $user_name);
        $query->bindValue(':email_user', $email_user);
        $query->bindValue(':Tel_user', $Tel_user);
        $query->bindValue(':password_user', $password_user);
        $query->bindValue(':avatar_user', $avatar_user);
        $query->bindValue(':id_user', $id_user);
        $query->execute();
        
        header('Location: Edit-user.php');
        exit;
    }
}

$query = $con->prepare('SELECT * FROM users WHERE id_user= ?');
$query->execute([$_GET['id']]);
$user = $query->fetch();

if (!$user) {
    header('Location: ./index.php');
    exit();
}
$page = 'Edit-user';
$template = 'Edit-user';
$pageTitle = 'Edit user';
include './layout-dash.phtml';

?>