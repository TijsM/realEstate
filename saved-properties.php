<?php
require_once(__DIR__ . '/components/top.php');
?>

<h1 class="text-center">SAVED PROPERTIES</h1>


<ul class="list-group col-lg-8 offset-lg-2" id="groupSavedProperties">
  <div class='list-group-item listHeader oneProp'>
    <div>Name</div>
    <div>Price</div>
    <div>Bedrooms</div>
    <div>Address </div>
    <div></div>
  </div>
</ul>



<?php
require_once(__DIR__ . '/components/bottom.php');
?>

<script>
  window.onload = fillSavedProperties();
</script>