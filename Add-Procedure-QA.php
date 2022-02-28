<?php
session_start();
// if (!isset($_SESSION['email'])) {
//   header('Location: ./Login_v2/login-manager.php');
//   exit();
// }

include './connexion.php';

function checkData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$errors = [];
$Num = '';
$Document_Title = '';
$Document_Control_Number = '';
$Related_documents = '';
$Issue = '';
$Issue_Date='';



if (!empty($_POST)) {
    $Num = checkData($_POST['Num']);
    $Document_Title = checkData($_POST['Document_Title']);
    $Document_Control_Number = checkData($_POST['Document_Control_Number']);
    $Related_documents = checkData($_POST['Related_documents']);
    $Issue = checkData($_POST['Issue']);
    $Issue_Date = checkData($_POST['Issue_Date']);
   
    if (empty($Num)) {
        $errors1['Num'] = 'Number is required';
    }
    if (empty($Document_Title)) {
        $errors1['Document_Title'] = 'Document_Title is required';
    }
    if(empty($Document_Control_Number)){
        $errors1['Document_Control_Number'] = 'Document_Control_Number valid is required';
    }
    if (empty($Related_documents)) {
        $errors1['Related_documents'] = 'Phone Number is required';
    }
    if (empty($Issue)) {
        $errors1['Issue'] = 'Issue is required';
    }
   
    if (empty($Issue_Date)) {
      $errors1['Issue_Date'] = 'Issue_Date is required';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO procedures_qa (Num ,Document_Title, Document_Control_Number, Related_documents ,Issue ,Issue_Date, id_manager) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = $con->prepare($sql);
        $query->execute([$Num, $Document_Title, $Document_Control_Number, $Related_documents, $Issue, $Issue_Date, $_SESSION['id_manager']]);
        header('Location: ./Procedure-QA.php');
        exit;
    }
}

$page= 'Add-Procedure-QA';
$pageTitle = 'Add Procedure-QA';
$template = 'Add-Procedure-QA';
include './layout.phtml';

?>