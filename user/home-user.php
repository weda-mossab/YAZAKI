<?php
include '../connexion.php';
session_start();
if (!isset($_SESSION['email_user'])) {
  header('Location: ../Login_v2/login-user.php');
  exit();
}
 
$template='home-user';
$pageTitle = 'Home';
$page = 'Home';
include './layout-user.phtml';
?>

<br><br><center><h4 style="font-weight: bold;margin-top:50px;"> HOME </h4></center><br>
<center>
<table class="table" style="background-color: #7a7a7a63;font-family:'Sofia Pro', sans-serif; border: 1px solid black;">
  <thead>
    <tr>
        <td>
        IMDS(International Material Data System)
        </td>
        <td>
        <button type="button" class="btn btn-dark">Enter</button>
        </td>
    </tr>
    <tr>
        <td>
        Be Standard System (NORMES FCA)
        </td>
        <td>
        <button type="button" class="btn btn-dark">Enter</button>
        </td>
    </tr>
    <tr>
        <td>
        RIDBUL (FCA Standard Components Catalogue)
        </td>
        <td>
        <button type="button" class="btn btn-dark">Enter</button>
        </td>
    </tr>
    <tr>
        <td>
        Yazaki Web Mail
        </td>
        <td>
        <button type="button" class="btn btn-dark">Enter</button>
        </td>
    </tr>
    <tr>
        <td>
        BCD
        </td>
        <td>
        <button type="button" class="btn btn-dark">Enter</button>
        </td>
    </tr>
    <tr>
        <td>
        Gestion Equimenents IT
        </td>
        <td>
        <button type="button" class="btn btn-dark">Enter</button>
        </td>
    </tr>
</table>
  </center>
  
       