<?php include 'connexion.php';?>
<?php

// if(isset($_GET['logout'])) {


// unset($_SESSION['id_manager']);
// unset($_SESSION['email_manager']);
// unset($_SESSION['manager_name']);
// unset($_SESSION['avatar']);
// unset($_SESSION['avatar_manager']);

// header('Location : ./Login_v2/login-admin.php');
// }

session_start();
session_unset();
header('Location: ./Login_v2/login-manager.php');
?>