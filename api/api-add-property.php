<?php

// ******* reading properties *************************************************
$sName = $_POST['name'];
$sPrice = $_POST['price'];
$sSize = $_POST['size'];
$sBedrooms = $_POST['bedrooms'];
$sDescription = $_POST['description'];
$sHouseNumber = $_POST['houseNumber'];
$sStreetName = $_POST['street'];
$sZipCode = $_POST['zipCode'];
$sCity = $_POST['city'];
$sCountry = $_POST['country'];
$sLongtitude = $_POST['longtitude'];
$sLatitude = $_POST['latitude'];

$sUploadedTime = time();
$sAgentId = $_POST['agentId'];

$aImages = $_FILES;

$sUniqueKey = uniqid();


// // ******* testing properties *************************************************
// echo "<div>$sPrice</div>";
// echo "<div>$sName</div>";
// echo "<div>$sSize</div>";
// echo "<div>$sBedrooms</div>";
// echo "<div>$sDescription</div>";
// echo "<div>$sHouseNumber</div>";
// echo "<div>$sStreetName</div>";
// echo "<div>$sZipCode</div>";
// echo "<div>$sCity</div>";
// echo "<div>$sCountry</div>";
// echo "<div>$sLongtitude</div>";
// echo "<div>$sLatitude</div>";

// echo "<div>$sUploadedTime</div>";
// echo "<div>$sAgentId</div>";

// print_r($aImages);




// ******* vallidation *************************************************





// ******* writing to file properties *************************************************

$sData = file_get_contents('../data.json');
$jData = json_decode($sData);


$jData->properties->$sUniqueKey = new stdClass();
$jData->properties->$sUniqueKey->agentId = $sAgentId;
$jData->properties->$sUniqueKey->uploadTime =$sUploadedTime;
$jData->properties->$sUniqueKey->name = $sName;
$jData->properties->$sUniqueKey->price = $sPrice;
$jData->properties->$sUniqueKey->size = $sSize;
$jData->properties->$sUniqueKey->bedrooms = $sBedrooms;
$jData->properties->$sUniqueKey->description = $sDescription;
$jData->properties->$sUniqueKey->location = new stdClass();
$jData->properties->$sUniqueKey->location->street = $sStreetName;
$jData->properties->$sUniqueKey->location->houseNumber = $sHouseNumber;
$jData->properties->$sUniqueKey->location->zipCode = $sZipCode;
$jData->properties->$sUniqueKey->location->city = $sCity;
$jData->properties->$sUniqueKey->location->country = $sCountry;
$jData->properties->$sUniqueKey->location->longtitude = $sLongtitude;
$jData->properties->$sUniqueKey->location->latitude = $sLatitude;
$jData->properties->$sUniqueKey->images = [];

//adding saving the images
// print_r($aImages);
$iAmountOfImages =  count($aImages['images']['tmp_name']);

for($index = 0; $index <= $iAmountOfImages-1; $index++){
    // echo $aImages['images']['tmp_name'][$index];
    $fileName=$sUniqueKey.'-'.$index.'.'.'png';

    //saving the file locally
    move_uploaded_file($aImages['images']['tmp_name'][$index],__DIR__."/../assets/uploadedProperties/$fileName");

    //saving the path
    $jData->properties->$sUniqueKey->images[$index] = $fileName;
}



// adding it to the user
$jData->users->$sAgentId->properties->$sUniqueKey = $sName;

$sData = json_encode($jData, JSON_PRETTY_PRINT);
file_put_contents('../data.json', $sData);

echo '{
    "status": 1 ,
    "message": "property was saved"
}';

