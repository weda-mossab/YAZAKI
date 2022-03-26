<?php
session_start();
if (isset($_SESSION['email_manager'])) {
    header('Location: ../index-manager.php');
    exit();
}

include '../connexion.php';

$errors1 = [];

if (isset($_POST['submit'])) {
    $email_manager = $_POST['email_manager'];
    $password_manager = $_POST['password_manager'];

    if((empty($email_manager) == true ) OR (empty($password_manager) == true)){
        $errors1[0] = 'you must fill in all the fields';
        goto show_form;
    } 

    if (filter_var($email_manager, FILTER_VALIDATE_EMAIL) == false) {       
        $errors1[0] = 'Enter a valid email';
        goto show_form;
    }
    
    $sql1 = "SELECT * FROM managers WHERE email_manager = :email_manager AND password_manager = :password_manager";
    $stmt1 = $con->prepare($sql1);
    $stmt1->execute([
        'email_manager' => $email_manager,
        'password_manager' => $password_manager
    ]);
    $manager = $stmt1->fetch();

    if ($manager == false) {
        $errors1[0] = 'invalid email or password';
        goto show_form;
    } else {
        if ($password_manager == $manager['password_manager']) {
            $_SESSION['id_manager'] = $manager['id_manager'];
            $_SESSION['email_manager'] = $manager['email_manager'];
            $_SESSION['manager_name'] = $manager['manager_name'];
            $_SESSION['avatar_manager'] = $manager['avatar_manager'];
            $_SESSION['Tel_manager'] = $manager['Tel_manager'];
            $_SESSION['department'] = $manager['department'];
            header('Location: ../index-manager.php');
        } else {
            $errors1[0] = 'invalid email or password';
            goto show_form;
        }
    }
}

show_form:
$namelog = 'Manager';
$template = 'login-manager';
$pageTitle = 'Manager Login page';
include './layout-log.phtml';

?>
  