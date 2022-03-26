<?php
include '../connexion.php';

session_start();
if (!isset($_SESSION['email_user'])) {
  header('Location: ../Login_v2/login-user.php');
  exit();
}
$query = $con->prepare("SELECT * FROM instructions_qa  ORDER BY id_Ins");
$query->execute();
$instructions_qa = $query->fetchAll();

$page = 'instructions QA';
$pageTitle = 'instructions QA';
include './layout-user.phtml';
?>

<header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">

          <div class="logo" style="margin-left: -80px; width:400px;">
            <a href="./home-user.php"><img src="../assets/img/yazaki.png" alt="" class="img-fluid"></a>
          </div>
          
        <nav id="navbar" class="navbar" style="margin-left:150px;">
            <ul>
              <li><a class="nav-link <?php if($page=='Home'){ echo 'active';} ?>" href="home-user.php">HOME</a></li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">IT<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                    <li><a href="#">IT Procedures </a></li>
                    <li><a href="#">IT Form</a></li>
                    <li><a href="#">Web Mail</a></li>
                    <li><a href="#">Phone</a></li>
                </ul>
             </li>

              <li class="dropdown"><a href="Procedures-qa.php"style="text-decoration: none;" class="nav-link <?php if($page=='Procedure QA'  || $page=='Instruction Qualité' || $page=='Politique' || $page=='YAPT Controle Plan' || $page=='Manual Qualité'){ echo 'active';} ?>">QUALITY<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                    <ul>
                    <li><a href="#" class="<?php if($page=='Instruction Qualité'){ echo 'active';} ?>">Instruction Qualité</a></li>
                    <li class="dropdown"><a href="#" class="<?php if($page=='Procedures QA'){ echo 'active';} ?>"> Procedure Qualité<i class="fa fa-chevron-right"></i></a>
                        <ul style="margin-left:52px;">
                        <li><a href="#" class="">Cutting Procedures</a></li>
                        <li><a href="Procedures-qa.php" class="<?php if($page=='Procedures QA'){ echo 'active';} ?>">Global Quality Strandard</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="<?php if($page=='Politique'){ echo 'active';} ?>">Politique / Mission et Vision <br> qualité & Certificat IATF 16949</a></li>
                    <li><a href="#" class="<?php if($page=='YAPT Controle Plan'){ echo 'active';} ?>">YAPT Controle Plan</a></li>
                    <li><a href="#" class="<?php if($page=='Manuel Qualité'){ echo 'active';} ?>">Manuel Qualité</a></li>
                    </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">RH<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                <li><a href="#">RH Procedure </a></li>
                  <li><a href="#">RH Instruction </a></li>
                  <li><a href="#">RH Manual </a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">FINANCE<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                <li><a href="#">Finance Procedures </a></li>
                <li><a href="#">Finance Instructions </a></li>
                <li><a href="#">Finance Manual </a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">LOGISTIC<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                <li><a href="#">LOGISTIC Procedures </a></li>
                <li><a href="#">LOGISTIC Instructions </a></li>
                <li><a href="#">LOGISTIC Manual </a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">PLPP/ENG<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                <li><a href="#">PLPP/ENG Procedures </a></li>
                <li><a href="#">PLPP/ENG Instructions </a></li>
                <li><a href="#">PLPP Manual </a></li>
                </ul>
              </li>
              <li><a class="dropdown" style="text-decoration: none;" href="#hero">PRODUCTION</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!--  end navbar -->
         &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          <div class="dropdown text-end" style="margin-right:-50px;">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img  src="./Dashboard/uploads/<?= $_SESSION['avatar_user'] ?>" alt="mdo" width="32" height="32" class="rounded-circle">
              </a> 
              <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><h6><a class="dropdown-item" href="#"><?= $_SESSION['user_name'] ?></a></h6></li>
                <li><a class="dropdown-item" href="#"><?= $_SESSION['email_user'] ?></a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="./logout-user.php">Logout</a></li>
              </ul>
            </div>
            <div class="b-example-divider"></div>
    </div>
  </header>
  <br>
      <section id="hero" style=" margin-top: 50px;">

      <br><br><center><h4 style="font-weight: bold;"> Instructions QA YAPT</h4></center><br>
<center><table class="table" style="width: 1300px;font-family:'Sofia Pro', sans-serif;">

<thead class="table-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">N°</th>
    </tr>
</thead>
<tbody class="tbody">
  <?php foreach ($instructions_qa as $instruction_qa) : ?>
                <tr>
                    <th scope="row"><?= $instruction_qa['id_Ins'] ?></th>
                    <td><?= $instruction_qa['Title'] ?></td>
                    <td><?= $instruction_qa['Num'] ?></td>
                </tr>
  <?php endforeach; ?>
</tbody>
</table></center>

</section>

