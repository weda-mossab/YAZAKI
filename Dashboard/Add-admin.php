<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}

include '../connexion.php';
include './utilities.php';

$connection= mysqli_connect("localhost","root","","yazaki");
$query1run = mysqli_query($connection, "SELECT COUNT(id) FROM admins");
$res = mysqli_fetch_array($query1run,MYSQLI_NUM);


$errors = [];
$admin_name = '';
$email = '';
$Tel = '';
$password = '';
$avatar='';

$err_nb = [];


if (!empty($_POST)) {
    $admin_name = checkData($_POST['admin_name']);
    $email = checkData($_POST['email']);
    $Tel = checkData($_POST['Tel']);
    $password = checkData($_POST['password']);
    $avatar=$_FILES["avatar"]["name"];
    if (empty($admin_name)) {
        $errors['admin_name'] = 'Full Name is required';
    }
    if (empty($email)) {
        $errors['email'] = 'email is required';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        $errors['email'] = 'please enter an email valid';
    }
    if (empty($Tel)) {
        $errors['Tel'] = 'Phone Number is required';
    }
    if((strlen($Tel)<8)){
        $errors['Tel'] = 'Phone Number should countaint 8 numbers';
    }
    if (empty($password)) {
        $errors['password'] = 'password is required';
    }
    if((strlen($password)<6)){
        $errors['Tel'] = 'weak password';
    }
    if (empty($avatar)) {
        $errors['avatar'] = 'avatar is required';
    }
    if($res>3){
        $err_nb['res'] = 'you cannot add more than 3 admins';
    }


    if (empty($errors) AND empty($err_nb)) {
            $targetDir = "./uploads/";
            //Recover file name from $_FILES
            $fileName = basename($_FILES["avatar"]["name"]);
            //The path to the uploaded file
            $targetFilePath = $targetDir . $fileName;
            //The extension of the uploaded file ( .jpg or .png )
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            //Input select 
            //Verify that the image is uploaded correctly   
            if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)){

                $sql = "INSERT INTO admins (admin_name, email, Tel, password, avatar) VALUES (?, ?, ?, ?, ?)";
                $query = $con->prepare($sql);
                $query->execute([$admin_name, $email, $Tel, $password ,$avatar]);
            
            } 
        header('Location: index.php');
        exit;
    }
}

$page= 'Add-admin';
$pageTitle = 'Add admin';
$template = 'Add-admin';
include './layout-dash.phtml';
?>