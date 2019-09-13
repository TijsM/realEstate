<?php
require_once(__DIR__ . '/components/top.php');
?>

<?php
$propId = $_GET['propId'];
// echo $propId;

$sData = file_get_contents('data.json');
$jData = json_decode($sData);
// echo json_encode($jData);

$jProperty = $jData->properties->$propId;
//  var_dump($jProperty);
?>


<div class="jumbotron col-lg-8  offset-lg-2 jumboAddProps">
    <h1 class="display-4">edit <?= $jProperty->name ?> </h1>
    <hr class="my-4">
    <form id="frmUpdateProperty" enctype="multipart/form-data">
        <h3>general</h3>

        <?php
        $userId = $_SESSION['jUser']->id;
        echo
        "
         <div class='form-group d-none'>
             <label for='agentId'>agentId</label>
             <input type='text' name='agentId' class='form-control' id='agentId' value='$userId'>
         </div>
        ";
        ?>
         <div class="form-group d-none">
            <label for="propId">name</label>
            <input type="text" name='propId' class="form-control" id="propId" value="<?= $jProperty->propertyId ?>">
        </div>

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name='name' class="form-control" id="name" value="<?= $jProperty->name ?>">
        </div>
        <div class="form-group">
            <label for="price">price (€)</label>
            <input type="number" name='price' class="form-control" id="price" value="<?= $jProperty->price ?>">
        </div>
        <div class="form-group">
            <label for="size">size (m²)</label>
            <input type="number" name='size' class="form-control" id="size" value='<?= $jProperty->size ?>'>
        </div>
        <div class="form-group">
            <label for="bedrooms">bedrooms</label>
            <input type="text" name='bedrooms' class="form-control" id="bedrooms" value="<?= $jProperty->bedrooms ?>">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <textarea class="form-control" name='description' id="description"   rows="8"><?= $jProperty->description ?></textarea>
        </div>
        
        <hr>
        <br><br>
        <h3>location</h3>
        <div class="form-group">
            <label for="houseNumber">house number</label>
            <input type="text" name='houseNumber' class="form-control" id="houseNumber" value="<?= $jProperty->location->houseNumber ?>">
        </div>
        <div class="form-group">
            <label for="street">streetname</label>
            <input type="text" name='street' class="form-control" id="street" value="<?= $jProperty->location->street ?>">
        </div>
        <div class="form-group">
            <label for="zipCode">zipCode</label>
            <input type="text" name='zipCode' class="form-control" id="zipCode" value="<?= $jProperty->location->zipCode ?>">
        </div>
        <div class="form-group">
            <label for="city">city</label>
            <input type="text" name='city' class="form-control" id="city" value="<?= $jProperty->location->city ?>">
        </div>
        <div class="form-group">
            <label for="county">country</label>
            <input type="text" name='country' class="form-control" id="country" value="<?= $jProperty->location->country ?>">
        </div>
        <div class="form-group">
            <label for="houseNumber">cordinates</label>
            <input type="text" name='longtitude' class="form-control" id="longtitude" value="<?= $jProperty->location->longtitude ?>">
            <br>
            <input type="text" name='latitude' class="form-control" id="latitude" value="<?= $jProperty->location->latitude ?>">
        </div>
        <hr>
        <br><br>
        <h3>images</h3>
        <div class="custom-file">
            <label class="custom-file-label" for="images">Choose file</label>
            <input type="file" multiple class="custom-file-input" id="images" name="images[]">
        </div>
        <button type="button" class="btn btn-primary" id="btnUpdateProperty">Submit</button>
    </form>
</div>



<?php
require_once(__DIR__ . '/components/bottom.php');
?>