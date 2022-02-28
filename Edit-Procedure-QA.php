<?php

session_start();
if (!isset($_SESSION['id_manager'])) {
  header('Location: ./Login_v2/login-manager.php');
  exit();
}

// if (!array_key_exists('id', $_GET) or !ctype_digit($_GET['id'])) {
//     header('Location: ./Procedures-QA.php');
//     exit();
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

if (!empty($_POST)) {
    $Num = checkData($_POST['Num']);
    $Document_Title = checkData($_POST['Document_Title']);
    $Document_Control_Number = checkData($_POST['Document_Control_Number']);
    $Related_documents = checkData($_POST['Related_documents']);
    $Issue = checkData($_POST['Issue']);
    $Issue_Date = checkData($_POST['Issue_Date']);
    $id_Prod_QA = checkData($_GET['id']);

    if (empty($Num)) {
        $errors['Num'] = ' Number is required';
    }
    if (empty($Document_Title)) {
        $errors['Document_Title'] = 'Document Title is required';
    }
    if(empty($Document_Control_Number)){
        $errors['Document_Control_Number'] = 'Document Control Number valid is required';
    }
  
    if (empty($Issue)) {
        $errors['Issue'] = 'Issue is required';
    }
   
    if (empty($Issue_Date)) {
      $errors['Issue_Date'] = 'Issue_Date is required';
    }

    if (empty($errors)) {
        $sql = "UPDATE procedures_qa 
                SET
                    Num = :Num,
                    Document_Title = :Document_Title,
                    Document_Control_Number = :Document_Control_Number,
                    Related_documents = :Related_documents,
                    Issue = :Issue,
                    Issue_Date = :Issue_Date
                WHERE id_Prod_QA = :id_Prod_QA";

        $query = $con->prepare($sql);
        $query->bindParam('Num', $Num);
        $query->bindParam('Document_Title', $Document_Title);
        $query->bindParam('Document_Control_Number', $Document_Control_Number);
        $query->bindParam('Related_documents', $Related_documents);
        $query->bindParam('Issue', $Issue);
        $query->bindParam('Issue_Date', $Issue_Date);
        $query->bindParam('id_Prod_QA', $id_Prod_QA);
        $query->execute();

        header('Location: ./Edit-Procedure-QA.php');
        exit();
    }
}

$query = $con->prepare('SELECT * FROM procedures_qa WHERE id_Prod_QA= ?');
$query->execute([$_GET['id']]);
$procedure_qa = $query->fetch();

if (!$procedure_qa) {
    header('Location: ./Procedure-QA.php');
    exit();
}

$page = 'Edit-Procedure-QA';
$template = 'Edit-Procedure-QA';
$pageTitle = 'Edit Procedure-QA';
include './layout.phtml';

?>