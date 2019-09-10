<?php

$sUserName = $_POST['name'];
$sFamilyName = $_POST['familyName'];
$sEmail = $_POST['email'];
$sPassword = $_POST['password'];
$sPhone = $_POST['phoneNumber'];

// echo $sPhone;

if(empty($sUserName)){
    sendErrorMessage('name is not filled in', __LINE__);
}
if(empty($sFamilyName)){
    sendErrorMessage('familyname is not filled in', __LINE__);
}
if(empty($sEmail)){
    sendErrorMessage('email is not filled in', __LINE__);
}
if(empty($sPassword)){
    sendErrorMessage('password is not filled in', __LINE__);
}
if(empty($sPhone)){
    sendErrorMessage('phonenumber is not filled in', __LINE__);
}

if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)){
    sendErrorMessage('the mail has not the correct format', __line__);
}

if (strlen($sPhone) < 11){
    sendErrorMessage('not a valid phone number, to short', __LINE__);
}

//validate the length of the password
if (strlen($sPhone) > 13){
    sendErrorMessage('not a valid phone number, to long', __line__);    
}


if (strlen($sPassword) < 6){
    sendErrorMessage('password to sort, must be at least 6 characters long', __LINE__);
}

//validate the length of the password
if (strlen($sPassword) > 50){
    sendErrorMessage('password too long, must be at least 50 chars long', __line__);    
}


//write the new data to the data file
$sUsers = file_get_contents('../data.json');
$jUsers = json_decode($sUsers);

$sUniqueId = uniqid();
$jUsers->agents->$sUniqueId = new stdClass();
$jUsers->agents->$sUniqueId->id = $sUniqueId;
$jUsers->agents->$sUniqueId->name = $sUserName;
$jUsers->agents->$sUniqueId->lastName = $sFamilyName;
$jUsers->agents->$sUniqueId->email = $sEmail;
$jUsers->agents->$sUniqueId->password = $sPassword;
$jUsers->agents->$sUniqueId->phone = $sPhone;
$jUsers->agents->$sUniqueId->properties = new stdClass();

$sUsers = json_encode($jUsers);
file_put_contents('../data.json', $sUsers);

$_SESSION['jUser'] = $jUsers->agents->$sUniqueId;

echo '{
    "status": 1 ,
    "message": "agent was registred"
}';


function sendErrorMessage($sMessage,  $iLine){
    echo '{
        "status": 0,
        "message": "'.$sMessage.'",
        "line": '.$iLine.'
    }';

    exit;
}