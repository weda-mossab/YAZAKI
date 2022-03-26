<?php
include './connexion.php';

session_start();
if (!isset($_SESSION['email_manager'])) {
  header('Location: ./Login_v2/login-manager.php');
  exit();
}

$query = $con->prepare("SELECT * FROM Instructions_qa  ORDER BY id_Ins");
$query->execute();
$Instructions_qa = $query->fetchAll();

$template='Instructions-QA';
$pageTitle = 'Instructions QA YAPT';
$page= 'Instructions-QA';
include './layout.phtml';

?>
