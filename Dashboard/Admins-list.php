<?php
include '../connexion.php';
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}

$query = $con->prepare("SELECT * FROM admins  ORDER BY id");
$query->execute();
$admins = $query->fetchAll();


$pageTitle = 'Admins-list';
$template = 'Admins-list';
$page= 'Admins-list';
include './layout-dash.phtml';
?>
