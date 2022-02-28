<?php
include '../connexion.php';
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}

$query = $con->prepare("SELECT * FROM users  ORDER BY id_user");
$query->execute();
$users = $query->fetchAll();


$pageTitle = 'Users-list';
$template = 'Users-list';
$page= 'Users-list';
include './layout-dash.phtml';
?>
