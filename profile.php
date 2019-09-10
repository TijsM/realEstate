<?php
require_once(__DIR__ . '/components/top.php');
?>

<?php
session_start();
$jUser = $_SESSION['jUser'];
$sUserName = $jUser->name;
$sUserFamilyname = $jUser->lastName;
$sUserEmail = $jUser->email;
$sUserPassword = $jUser->password;
$sUserIsAgent = $jUser->isAgent;
$sUserTelephone = '';
if($sUserIsAgent == 'true'){
  $sUserTelephone = $jUser->phone;
}
?>



<div class="jumbotron ol col-lg-8  offset-lg-2 jumboUser">
  <h1 class="display-4">Hi <?= $sUserName ?> <?= $sUserFamilyname ?>!</h1>
  <p class="lead">view and edit your data</p>
  <hr class="my-4">
  <form>
    <div class="form-group">
      <label for="name">name</label>
      <input type="text" class="form-control" id="name" value="<?= $sUserName?>">
    </div>
    <div class="form-group">
      <label for="familyname">familyname</label>
      <input type="text" class="form-control" id="familyname" value="<?= $sUserFamilyname?>">
    </div>
    <div class="form-group">
      <label for="email">email</label>
      <input type="text" class="form-control" id="email" value="<?= $sUserEmail?>">
    </div>
    <!-- <div class="form-group">
      <label for="password">password</label>
      <input type="text" class="form-control" id="password">
    </div> -->

    <?php
        if($sUserIsAgent=='true'){
          echo "
          <div class='form-group'>
              <label for='phone'></label>phone number</label>
              <input type='text' class='form-control' id='phone' value='$sUserTelephone'>
          </div>
          ";
        }

    ?>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>




<?php
require_once(__DIR__ . '/components/bottom.php');
?>