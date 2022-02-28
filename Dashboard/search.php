


<?php include '../connexion.php';?>

<?php
$req="SELECT * from admins where admin_name LIKE '% ".$_POST['admin_name']."%' ";
$res=$con->query($req);
while($data=$res->fetch()){
    ?>
<div class="card" style="width: 18rem;">
    <h5 class="card-text"><?= $data['id'] ?></h5>
    <img class="card-img-top" src="./uploads/<?= $data['avatar'] ?>" alt="Card image cap">
    <h5 class="card-title"><?= $data['admin_name'] ?></h5>
    <h5 class="card-text"><?= $data['email'] ?></h5>
    <h5 class="card-title"><?= $data['password'] ?></h5>
    <h5 class="card-text"><?= $data['Tel'] ?></h5>

</div>

    <?php
}
?>