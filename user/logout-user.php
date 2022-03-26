<?php include '../connexion.php';?>
<?php

// if(isset($_GET['logout'])) {

// session_destroy();
// unset($_SESSION['id']);
// unset($_SESSION['email']);
// unset($_SESSION['admin_name']);
// unset($_SESSION['avatar']);

// header('Location : ./Login_v2/login-admin.php');
// }

session_start();
session_unset();
header('Location: ../Login_v2/login-user.php');
?>