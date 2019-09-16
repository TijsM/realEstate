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

$sUniqueKey = $_POST['propId'];


// ******* testing properties *************************************************
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


session_start();
// checking if logged in
if($_SESSION['jUser']->id != $sAgentId){
    sendErrorMessage('user is not logged in or does not has this permission', __LINE__);
}



//checking if everything is filled in
if (empty($sName)) {
    sendErrorMessage('name can not be empty', __LINE__);
}

if (empty($sPrice)) {
    sendErrorMessage('price can not be empty', __LINE__);
}

if (empty($sSize)) {
    sendErrorMessage('size can not be empty', __LINE__);
}

if (empty($sBedrooms)) {
    sendErrorMessage('bedrooms can not be empty', __LINE__);
}

if (empty($sDescription)) {
    sendErrorMessage('description can not be empty', __LINE__);
}

if (empty($sHouseNumber)) {
    sendErrorMessage('housenumber can not be empty', __LINE__);
}

if (empty($sStreetName)) {
    sendErrorMessage('streetname can not be empty', __LINE__);
}

if (empty($sZipCode)) {
    sendErrorMessage('zipcode can not be empty', __LINE__);
}

if (empty($sCity)) {
    sendErrorMessage('city can not be empty', __LINE__);
}

if (empty($sCountry)) {
    sendErrorMessage('country can not be empty', __LINE__);
}

if (empty($sLongtitude) || empty($sLatitude)) {
    sendErrorMessage('cordinates can not be empty', __LINE__);
}
    

//checking the length of certain properties
if(strlen($sName)>120){
    sendErrorMessage('name can not exceed the 120 chararcters limitation',__line__);
}

if($sLongtitude>180 || $sLatitude> 180){
    sendErrorMessage('please fill in correct cordinates',__LINE__);
}


function sendErrorMessage($sMessage,  $iLine)
{
    echo '{
        "status": 0,
        "message": "' . $sMessage . '",
        "line": ' . $iLine . '
    }';

    exit;
}



// ******* writing to file properties *************************************************

$sData = file_get_contents('../data.json');
$jData = json_decode($sData);


$jData->properties->$sUniqueKey = new stdClass();
$jData->properties->$sUniqueKey->propertyId = $sUniqueKey;
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
// $jData->properties->$sUniqueKey->images = [];

$iAmountOfImages =  count($aImages['images']['tmp_name']);

if($iAmountOfImages != 0){
    for($index = 0; $index <= $iAmountOfImages-1; $index++){
            // echo $aImages['images']['tmp_name'][$index];
            $fileName=$sUniqueKey.'-'.$index.'.'.'png';
        
            //saving the file locally
            move_uploaded_file($aImages['images']['tmp_name'][$index],__DIR__."/../assets/uploadedProperties/$fileName");
        
            //saving the path
            $jData->properties->$sUniqueKey->images[$index] = $fileName;
        }
        
}




$sData = json_encode($jData, JSON_PRETTY_PRINT);
file_put_contents('../data.json', $sData);

echo '{
    "status": 1 ,
    "message": "property was updated"
}';

