<?php
require_once(__DIR__ . '/components/top.php');
?>

<div class="jumbotron col-lg-8  offset-lg-2 jumboAddProps">
    <h1 class="display-4">Add a new property</h1>
    <hr class="my-4">
    <form id="frmAddProperty" enctype="multipart/form-data">
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

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name='name' class="form-control" id="name" placeholder="luxurious villa in Ghent">
        </div>
        <div class="form-group">
            <label for="price">price (€)</label>
            <input type="number" name='price' class="form-control" id="price" placeholder="500.000">
        </div>
        <div class="form-group">
            <label for="size">size (m²)</label>
            <input type="number" name='size' class="form-control" id="size" placeholder="425">
        </div>
        <div class="form-group">
            <label for="bedrooms">bedrooms</label>
            <input type="text" name='bedrooms' class="form-control" id="bedrooms" placeholder="3">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <textarea class="form-control" name='description' id="description" rows="8"></textarea>
        </div>
        <h3>location</h3>
        <div class="form-group">
            <label for="houseNumber">house number</label>
            <input type="text" name='houseNumber' class="form-control" id="houseNumber" placeholder="45">
        </div>
        <div class="form-group">
            <label for="street">streetname</label>
            <input type="text" name='street' class="form-control" id="street" placeholder="Highstreet">
        </div>
        <div class="form-group">
            <label for="zipCode">zipCode</label>
            <input type="text" name='zipCode' class="form-control" id="zipCode" placeholder="9810">
        </div>
        <div class="form-group">
            <label for="city">city</label>
            <input type="text" name='city' class="form-control" id="city" placeholder="Ghent">
        </div>
        <div class="form-group">
            <label for="county">country</label>
            <input type="text" name='country' class="form-control" id="country" placeholder="Belgium">
        </div>
        <div class="form-group">
            <label for="houseNumber">cordinates</label>
            <input type="text" name='longtitude' class="form-control" id="longtitude" placeholder="longtitude - 51.054967">
            <br>
            <input type="text" name='latitude' class="form-control" id="latitude" placeholder="latitude - 3.715892">
        </div>

        <h3>images</h3>
        <div class="custom-file">
            <label class="custom-file-label" for="images">Choose file</label>
            <input type="file" multiple class="custom-file-input" id="images" name="images[]">
        </div>
        <button type="button" class="btn btn-primary" id="btnSubmitProperty">Submit</button>
    </form>
</div>


<?php
require_once(__DIR__ . '/components/bottom.php');
?>