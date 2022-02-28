
<?php

session_start();
if (!isset($_SESSION['email_manager'])) {
  header('Location: ./Login_v2/login-manager.php');
  exit();
}



$template='index-manager';
$pageTitle = 'index Manager';
$page = 'home';
include './layout.phtml';
include './connexion.php';
?>



 
      
 