<?php
session_start();
if (isset($_SESSION['email_user'])) {
    header('Location: ../user/landing-page.php');
    exit();
}

include '../connexion.php';

$errors1 = [];

if (isset($_POST['submit1'])) {
    $email_user = $_POST['email_user'];
    $password_user = $_POST['password_user'];

    if((empty($email_user) == true ) OR (empty($password_user) == true)){
        $errors1[0] = 'you must fill in all the fields';
        goto show_form;
    } 

    if (filter_var($email_user, FILTER_VALIDATE_EMAIL) == false) {       
        $errors1[0] = 'Enter a valid email';
        goto show_form;
    }
    
    $sql1 = "SELECT * FROM users WHERE email_user = :email_user AND password_user = :password_user";
    $stmt1 = $con->prepare($sql1);
    $stmt1->execute([
        'email_user' => $email_user,
        'password_user' => $password_user
    ]);
    $user = $stmt1->fetch();

    if ($user == false) {
        $errors1[0] = 'invalid email or password';
        goto show_form;
    } else {
        if ($password_user == $user['password_user']) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['email_user'] = $user['email_user'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['avatar_user'] = $user['avatar_user'];
            $_SESSION['Tel_user'] = $user['Tel_user'];
            $_SESSION['department'] = $user['department'];
            header('Location: ../user/landing-page.php');
        } else {
            $errors1[0] = 'invalid email or password';
            goto show_form;
        }
    }
}

show_form:
$namelog = 'User';
$template = 'login-user';
$pageTitle = 'User Login page';
include './layout-log.phtml';
?>
  