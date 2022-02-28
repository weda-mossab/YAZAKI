
<?php
include './connexion.php';

session_start();
if (!isset($_SESSION['email_manager'])) {
  header('Location: ./Login_v2/login-manager.php');
  exit();
}

$query = $con->prepare("SELECT * FROM procedures_qa  ORDER BY id_Prod_QA");
$query->execute();
$procedures_qa = $query->fetchAll();


$template='Procedure-QA';
$pageTitle = 'Procedure QA YAPT';
$page='Procedure-QA';
include './layout.phtml';

?>

