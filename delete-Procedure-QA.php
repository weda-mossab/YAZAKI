<?php

session_start();
if (!isset($_SESSION['email_manager'])) {
  header('Location: ./Login_v2/login-manager.php');
  exit();
}

if (!array_key_exists('id', $_GET) or !ctype_digit($_GET['id'])) {
    header('Location: ./Procedure-QA.php');
    exit();
}
include './connexion.php';

$query4 = $con->prepare('DELETE FROM procedures_qa WHERE id_Prod_QA= :id_Prod_QA');
$query4->execute([
    'id_Prod_QA' => $_GET['id']
]);

header('Location: ./Procedure-QA.php');
exit();

?>