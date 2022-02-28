<?php

include '../connexion.php';

$query = $con->prepare("SELECT * FROM procedures_qa  ORDER BY id_Prod_QA");
$query->execute();
$procedures_qa = $query->fetchAll();

$page = 'Procedure QA';
$pageTitle = 'Procedures QA';
include './layout-user.phtml';
?>

<header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">

          <div class="logo" style="margin-left: -80px; width:400px;">
            <a href="index-admin.php"><img src="../assets/img/yazaki.png" alt="" class="img-fluid"></a>
          </div>
          
        <nav id="navbar" class="navbar" style="margin-left:150px;">
            <ul>
              <li><a class="nav-link " href="home-user.php">HOME</a></li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">IT<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                    <ul>
                    <li><a href="#">Drop Down 1</a></li>
                    <li><a href="#">Drop Down 2</a></li>
                    <li><a href="#">Drop Down 3</a></li>
                    <li><a href="#">Drop Down 4</a></li>
                    </ul>
             </li>

              <li class="dropdown"><a href="#"style="text-decoration: none;" class="nav-link <?php if($page=='Procedure QA' || $page=='Instruction Qualité' || $page=='Politique' || $page=='YAPT Controle Plan' || $page=='Manuel Qualité'){ echo 'active';} ?>">QUALITY<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                    <ul>
                    <li><a href="Procedures-qa.php" class="nav-link <?php if($page=='Procedure QA'){ echo 'active';} ?>">Procedure Qualité</a></li>
                    <li class="dropdown"><a href="#">Instruction Qualité<i class="fa fa-chevron-right"></i></a>
                        <ul style="margin-left:52px;">
                        <li><a href="#" class="">Drop Down 3</a></li>
                        <li><a href="#" class="">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="">Politique / Mission et Vision <br> qualité & Certificat IATF 16949</a></li>
                    <li><a href="#" class="">YAPT Controle Plan</a></li>
                    <li><a href="#" class="">Manuel Qualité</a></li>
                    </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">RH<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li><a href="#">Drop Down 2</a></li>
                  <li><a href="#">Drop Down 3</a></li>
                  <li><a href="#">Drop Down 4</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">FINANCE<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li><a href="#">Drop Down 2</a></li>
                  <li><a href="#">Drop Down 3</a></li>
                  <li><a href="#">Drop Down 4</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">LOGISTIC<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li><a href="#">Drop Down 2</a></li>
                  <li><a href="#">Drop Down 3</a></li>
                  <li><a href="#">Drop Down 4</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" style="text-decoration: none;">PLPP/ENG<i class="fa fa-chevron-down" style="font-size:14px"></i></a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li><a href="#">Drop Down 2</a></li>
                  <li><a href="#">Drop Down 3</a></li>
                  <li><a href="#">Drop Down 4</a></li>
                </ul>
              </li>
              <li><a class="dropdown" style="text-decoration: none;" href="#hero">PRODUCTION</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!--  end navbar -->
              <div class="b-example-divider"></div>
    </div>
  </header>
  <br>
      <section id="hero" style=" margin-top: 50px;">

      <br><br><center><h4 style="font-weight: bold;"> Procedures QA YAPT</h4></center><br>
<center><table class="table" style="width: 1300px;font-family:'Sofia Pro', sans-serif;">

  <thead class="table-dark" >
    <tr>
    <th scope="col" >id</th>
      <th scope="col" >N°</th>
      <th scope="col" >Document Title</th>
      <th scope="col" >Document Control Number</th>
      <th scope="col" >Related documents</th> 
      <th scope="col" >Issue</th>
      <th scope="col" colspan="2">Issue Date</th>
    </tr>
  </thead>
  <tbody class="tbody">
  <?php foreach ($procedures_qa as $procedure_qa) : ?>
                    <tr>
                    <th scope="row" ><?= $procedure_qa['id_Prod_QA'] ?></th>
                    <td ><?= $procedure_qa['Num'] ?></td>
                    <td ><?= $procedure_qa['Document_Title'] ?></td>
                    <td ><?= $procedure_qa['Document_Control_Number'] ?></td>
                    <td ><?= $procedure_qa['Related_documents'] ?></td>
                    <td ><?= $procedure_qa['Issue'] ?></td>
                    <td ><?= $procedure_qa['Issue_Date'] ?></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
  </tbody>
</table></center>

</section>

