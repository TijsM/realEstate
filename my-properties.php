<?php
require_once(__DIR__ . '/components/top.php');
?>

<?php

$jUser = $_SESSION['jUser'];
// echo json_encode($jUser);

$sData = file_get_contents('data.json');
$jData = json_decode($sData);

$agentId = $jUser->id;
$jPropertiesOfUser = $jData->users->$agentId->properties;
?>
<div id="myPropertiesContainer">
    <h1 class="text-center">MY PROPERTIES</h1>

    <div class="propertyList">
        <ul class="list-group col-lg-8 offset-lg-2">
            <div class='list-group-item listHeader oneProp'>
                <div>Name</div>
                <div>Price</div>
                <div>Bedrooms</div>
                <div>Address </div>
                <div>Edit/Hide</div>
            </div>
            <?php
            foreach ($jPropertiesOfUser as $sKey => $sPropName) {
                $jProp = $jData->properties->$sKey;

                echo "
                     <div class='list-group-item oneProp'>
                        <div><strong>$jProp->name</strong></div>
                        <div>$jProp->price</div>
                        <div>$jProp->bedrooms</div>
                        <div>{$jProp->location->city} - {$jProp->location->street} - {$jProp->location->houseNumber} </div>
                        <div>
                            <a href='edit-property.php?propId=$jProp->propertyId'><i class='fas fa-edit iconMyProperties'></i></a>
                           
                            <a href='delete-property.php?propId=$jProp->propertyId'> <i class='fas fa-eye-slash iconMyProperties'></i></i></a>
                        </div>
                     </div>
                     ";
            }
            ?>
        </ul>
    </div>
</div>


<button type="button" class="btn btn-secondary col-lg-6 offset-lg-3" id="btnShowDeleted">show hidden properties</button>


<div >
    
</div>

<ul class="list-group col-lg-8 offset-lg-2" id="deletedProps">

</ul>


<?php
require_once(__DIR__ . '/components/bottom.php');
?>