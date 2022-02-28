<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}

include '../connexion.php';
include './utilities.php';

$errors1 = [];
$user_name = '';
$email_user = '';
$Tel_user = '';
$password_user = '';
$avatar_user='';
$department='';


if (!empty($_POST)) {
    $user_name = checkData($_POST['user_name']);
    $email_user = checkData($_POST['email_user']);
    $Tel_user = checkData($_POST['Tel_user']);
    $password_user = checkData($_POST['password_user']);
    $avatar_user=$_FILES["avatar_user"]["name"];
    $department = checkData($_POST['department']);
    
    if (empty($user_name)) {
        $errors1['user_name'] = 'Full Name is required';
    }
    if (empty($email_user)) {
        $errors1['email_user'] = 'email user is required';
    }
    if(filter_var($email_user, FILTER_VALIDATE_EMAIL) == false){
        $errors1['email_user'] = 'please enter an email_user valid';
    }
    if (empty($Tel_user)) {
        $errors1['Tel_user'] = 'Phone Number is required';
    }
    if (empty($password_user)) {
        $errors1['password_user'] = 'password_user is required';
    }
   
    if (empty($avatar_user)) {
      $errors1['avatar_user'] = 'avatar user is required';
    }

    if (empty($errors1)) {
            $targetDir1 = "./uploads/";
            //Recover file name from $_FILES
            $fileName1 = basename($_FILES["avatar_user"]["name"]);
            //The path to the uploaded file
            $targetFilePath1 = $targetDir1 . $fileName1;
            //The extension of the uploaded file ( .jpg or .png )
            $fileType1 = pathinfo($targetFilePath1,PATHINFO_EXTENSION);
            //Input select 
            //Verify that the image is uploaded correctly
            if(move_uploaded_file($_FILES["avatar_user"]["tmp_name"], $targetFilePath1)){
                $sql = "INSERT INTO users (user_name, email_user, Tel_user, password_user, avatar_user, department, id) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $query = $con->prepare($sql);
                $query->execute([$user_name, $email_user, $Tel_user, $password_user ,$avatar_user ,$department, $_SESSION['id']]);
                
            }    
        header('Location: users-list.php');
        exit;
    }
}

$page= 'Add-User';
$pageTitle = 'Add user';
$template = 'Add-user';
include './layout-dash.phtml';
?>