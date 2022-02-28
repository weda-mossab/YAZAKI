<?php

session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}


if (!array_key_exists('id', $_GET) or !ctype_digit($_GET['id'])) {
    header('Location: ./index.php');
    exit();
}

include '../connexion.php';
$query = $con->prepare('DELETE FROM admins WHERE id= :id');
$query->execute([
    'id' => $_GET['id']
]);

header('Location: ./Admins-list.php');
exit();

?>