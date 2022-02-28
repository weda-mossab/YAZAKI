<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}

include '../connexion.php';
include './utilities.php';

$errors1 = [];
$manager_name = '';
$email_manager = '';
$Tel_manager = '';
$password_manager = '';
$avatar_manager='';
$department='';


if (!empty($_POST)) {
    $manager_name = checkData($_POST['manager_name']);
    $email_manager = checkData($_POST['email_manager']);
    $Tel_manager = checkData($_POST['Tel_manager']);
    $password_manager = checkData($_POST['password_manager']);
    $avatar_manager=$_FILES["avatar_manager"]["name"];
    $department = checkData($_POST['department']);
    
    if (empty($manager_name)) {
        $errors1['manager_name'] = 'Full Name is required';
    }
    if (empty($email_manager)) {
        $errors1['email_manager'] = 'email manager is required';
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
      $errors1['avatar_manager'] = 'avatar manager is required';
    }

    if (empty($errors1)) {
            $targetDir1 = "./uploads/";
            //Recover file name from $_FILES
            $fileName1 = basename($_FILES["avatar_manager"]["name"]);
            //The path to the uploaded file
            $targetFilePath1 = $targetDir1 . $fileName1;
            //The extension of the uploaded file ( .jpg or .png )
            $fileType1 = pathinfo($targetFilePath1,PATHINFO_EXTENSION);
            //Input select 
            //Verify that the image is uploaded correctly
            if(move_uploaded_file($_FILES["avatar_manager"]["tmp_name"], $targetFilePath1)){
                $sql = "INSERT INTO managers (manager_name, email_manager, Tel_manager, password_manager, avatar_manager, department, id) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $query = $con->prepare($sql);
                $query->execute([$manager_name, $email_manager, $Tel_manager, $password_manager ,$avatar_manager ,$department, $_SESSION['id']]);
                
            }    
        header('Location: Managers-list.php');
        exit;
    }
}

$page= 'Add-Manager';
$pageTitle = 'Add manager';
$template = 'Add-manager';
include './layout-dash.phtml';
?>