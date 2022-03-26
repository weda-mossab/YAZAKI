
<?php 
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../Login_v2/login-admin.php');
  exit();
}
include '../connexion.php';
//search by name
$search = $_POST['search_type'];
if ($search==0){
  $req="SELECT * from admins where upper(admin_name) LIKE upper ('%".$_POST['search']."%')";
  $res=$con->query($req);
  $res->execute();
  
  $req1="SELECT * from managers where upper(manager_name) LIKE upper ('%".$_POST['search']."%') ";
  $res1=$con->query($req1);
  $res1->execute();
  
  $req2="SELECT * from users where upper(user_name) LIKE upper ('%".$_POST['search']."%') ";
  $res2=$con->query($req2);
  $res2->execute();
  
  $r=$res->rowCount();
  $r1=$res1->rowCount();
  $r2=$res2->rowCount();
}
else if ($search==1){
//search by email
$req="SELECT * from admins where upper(email) LIKE upper ('%".$_POST['search']."%')";
$res=$con->query($req);
$res->execute();

$req1="SELECT * from managers where upper(email_manager) LIKE upper ('%".$_POST['search']."%') ";
$res1=$con->query($req1);
$res1->execute();

$req2="SELECT * from users where upper(email_user) LIKE upper ('%".$_POST['search']."%') ";
$res2=$con->query($req2);
$res2->execute();
  
$r=$res->rowCount();
$r1=$res1->rowCount();
$r2=$res2->rowCount();
}
else if ($search==2){
  //search by phone number
$req="SELECT * from admins where Tel LIKE '%".$_POST['search']."%'";
$res=$con->query($req);
$res->execute();

$req1="SELECT * from managers where Tel_manager LIKE '%".$_POST['search']."%'";
$res1=$con->query($req1);
$res1->execute();

$req2="SELECT * from users where Tel_user LIKE '%".$_POST['search']."%' ";
$res2=$con->query($req2);
$res2->execute();

$r=$res->rowCount();
$r1=$res1->rowCount();
$r2=$res2->rowCount();
}
$page= 'search';
$pageTitle = 'search';
$template = 'search';
include './layout-dash.phtml';
?>
