<?php
include '../connexion.php';
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}

$query = $con->prepare("SELECT * FROM managers  ORDER BY id_manager");
$query->execute();
$managers = $query->fetchAll();


$pageTitle = 'Managers-list';
$template = 'Managers-list';
$page= 'Managers-list';
include './layout-dash.phtml';
?>
