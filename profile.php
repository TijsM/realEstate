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
$sUserId = $jUser->id;
$sUserTelephone = '';
//if user telephone is not empty,
if ($sUserIsAgent == 'true') {
  $sUserTelephone = $jUser->phone;
}
?>



<div class="jumbotron ol col-lg-8  offset-lg-2 jumboUser">
  <h1 class="display-4">Hi <?= $sUserName ?> <?= $sUserFamilyname ?>!</h1>
  <p class="lead">view and edit your data</p>
  <hr class="my-4">
  <form id='frmUpdateUser'>
    <div class="form-group d-none">
      <label for="userId">id</label>
      <input type="text" name="userId" class="form-control" id="userId" value="<?= $sUserId ?>">
    </div>
    <div class="form-group">
      <label for="name">name</label>
      <input type="text" name="name" class="form-control" id="name" value="<?= $sUserName ?>">
    </div>
    <div class="form-group">
      <label for="familyname">familyname</label>
      <input type="text" name="familyName" class="form-control" id="familyname" value="<?= $sUserFamilyname ?>">
    </div>
    <div class="form-group">
      <label for="email">email</label>
      <input type="text" name="email" class="form-control" id="email" value="<?= $sUserEmail ?>">
    </div>
    <?php
    if ($sUserIsAgent == 'true') {
      echo "
          <div class='form-group' id='agentPhone'>
              <label for='phone'></label>phone number</label>
              <input type='text'name='phone' class='form-control' id='phone' value='$sUserTelephone'>
          </div>
          ";
    }

    ?>

    <button type="button" class="btn btn-primary" id="frmUpdateUserConfirm">Submit</button>
    <div id="updateError"></div>
  </form>

</div>




<?php
require_once(__DIR__ . '/components/bottom.php');
?>