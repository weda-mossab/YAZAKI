<?php
include '../connexion.php';
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}

$connection= mysqli_connect("localhost","root","","yazaki");
$query1run = mysqli_query($connection, "SELECT COUNT(id) FROM admins");
$res = mysqli_fetch_array($query1run,MYSQLI_NUM);

$query2run = mysqli_query($connection, "SELECT COUNT(id_manager) FROM managers");
$res1 = mysqli_fetch_array($query2run,MYSQLI_NUM);

$query3run = mysqli_query($connection, "SELECT COUNT(id_Prod_QA) FROM procedures_qa");
$res2  = mysqli_fetch_array($query3run,MYSQLI_NUM);

$query4run = mysqli_query($connection, "SELECT COUNT(id_user) FROM users");
$res3  = mysqli_fetch_array($query4run,MYSQLI_NUM);

$pageTitle = 'Dashboard';
$template = 'index';
$page='Dashboard';
include './layout-dash.phtml';

?>