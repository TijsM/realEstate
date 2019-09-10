<?php
require_once(__DIR__ . '/components/top.php');
?>

<?php
session_start();
$jUser = $_SESSION['jUser'];
$sUserName = $jUser->name;
$sUserFamilyname = $jUser->lastName;

?>



<div class="jumbotron">
  <h1 class="display-4">Hi <?= $sUserName?> <?= $sUserFamilyname?></h1>
  <p class="lead">view and edit your data</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>



<?php
require_once(__DIR__ . '/components/bottom.php');
?>