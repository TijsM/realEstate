<?php
require_once(__DIR__ . '/components/top.php');
?>

<?php

$propId = $_GET['propId'];


$jData = json_decode(file_get_contents('data.json'));
// print_r($jData);
$jProp = $jData->properties->$propId;
?>


<div class="jumbotron col-lg-6 offset-lg-3">
  <h1 class="display-4">Are you sure you want to hide this property?</h1>
  <p>name: <?= $jProp->name ?></p>
  <p>price: <?= $jProp->price ?></p>
  <p>decripton: <?= $jProp->description ?></p>
  
  <a class="btn btn-danger btn-lg" href="#" onclick="deleteProp()" role="button">Hide</a>
  <a class="btn btn-secundare btn-lg" href="my-properties.php" role="button">cancel</a>
</div>


<script>
    function deleteProp(){
        let id = '<?= $jProp->propertyId;?>';
        console.log(id);

        $.ajax({
        url: "api/api-delete-property.php?propId="+id,
        method: "GET",
        dataType: "JSON"
    })
        .done(function (jData) {
            window.location.pathname = 'PROJECT/my-properties.php'
        })
        .fail(function(){
            window.location.pathname = 'PROJECT/my-properties.php'
        })
    }
</script>


<?php
require_once(__DIR__ . '/components/bottom.php');
?>

