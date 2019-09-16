<?php

$sUserName = $_POST['name'];
$sFamilyName = $_POST['familyName'];
$sEmail = $_POST['email'];
$sPassword = $_POST['password'];


// echo $sUserName;
// echo $sFamilyName;
// echo $sEmail;
// echo $sPassword;

if (empty($sUserName)) {
    sendErrorMessage('name is not filled in', __LINE__);
}
if (empty($sFamilyName)) {
    sendErrorMessage('familyname is not filled in', __LINE__);
}
if (empty($sEmail)) {
    sendErrorMessage('email is not filled in', __LINE__);
}
if (empty($sPassword)) {
    sendErrorMessage('password is not filled in', __LINE__);
}


if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage('the mail has not the correct format', __line__);
}


//validate the length of the password
if (strlen($sPassword) < 6) {
    sendErrorMessage('password to sort, must be at least 6 characters long', __LINE__);
}

//validate the length of the password
if (strlen($sPassword) > 50) {
    sendErrorMessage('password too long, must be at least 50 chars long', __line__);
}



//write the new data to the data file
$sUsers = file_get_contents('../data.json');
$jUsers = json_decode($sUsers);

foreach ($jUsers->users as $sUserId => $jUser) {
    if ($sEmail == $jUser->email) {
        sendErrorMessage('This email address is already in use, try to log in', __LINE__);
    }
}

$sUniqueId = uniqid();
$jUsers->users->$sUniqueId = new stdClass();
$jUsers->users->$sUniqueId->isAgent = 'false';
$jUsers->users->$sUniqueId->id = $sUniqueId;
$jUsers->users->$sUniqueId->name = $sUserName;
$jUsers->users->$sUniqueId->lastName = $sFamilyName;
$jUsers->users->$sUniqueId->email = $sEmail;
$jUsers->users->$sUniqueId->password = $sPassword;
$jUsers->users->$sUniqueId->likedProperties = [];


$sUsers = json_encode($jUsers);
file_put_contents('../data.json', $sUsers);

session_start();
$_SESSION['jUser'] = $jUsers->users->$sUniqueId;

echo '{
    "status": 1 ,
    "message": "user was registred"
}';


function sendErrorMessage($sMessage,  $iLine)
{
    echo '{
        "status": 0,
        "message": "' . $sMessage . '",
        "line": ' . $iLine . '
    }';

    exit;
}
