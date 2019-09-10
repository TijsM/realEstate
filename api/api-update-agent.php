<?php
$sUserId = $_POST['userId'];
$sUserName = $_POST['name'];
$sFamilyName = $_POST['familyName'];
$sEmail = $_POST['email'];
$sPhone = $_POST['phone'];

session_start();
//  echo $_SESSION['jUser']->id;
//  echo '<div></div>';
//  echo $sUserId;

if($_SESSION['jUser']->id != $sUserId){
    sendErrorMessage('user is not logged in or does not has this permition', __LINE__);
}

if (empty($sUserId)) {
    sendErrorMessage('id is not found', __LINE__);
}
if (empty($sUserName)) {
    sendErrorMessage('name is not filled in', __LINE__);
}
if (empty($sFamilyName)) {
    sendErrorMessage('familyname is not filled in', __LINE__);
}
if (empty($sEmail)) {
    sendErrorMessage('email is not filled in', __LINE__);
}
if(empty($sPhone)){
    sendErrorMessage('phonenumber is not filled in', __LINE__);
}

if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage('the mail has not the correct format', __line__);
}


if (strlen($sPhone) < 11){
    sendErrorMessage('not a valid phone number, to short', __LINE__);
}

//validate the length of the password
if (strlen($sPhone) > 13){
    sendErrorMessage('not a valid phone number, to long', __line__);    
}


//write the new data to the data file
$sUsers = file_get_contents('../data.json');
$jUsers = json_decode($sUsers);


//if the mail is changed
if ($sEmail != $jUsers->users->$sUserId->email) {
    //check if the mail is not used by another user
    foreach ($jUsers->users as $idUser => $jUser) {
        if ($sEmail == $jUser->email) {
            sendErrorMessage('This email address is already in use, try to log in', __LINE__);
        }
    }
}

$jUsers->users->$sUserId->name = $sUserName;
$jUsers->users->$sUserId->lastName = $sFamilyName;
$jUsers->users->$sUserId->phone = $sPhone;
$jUsers->users->$sUserId->email = $sEmail;


$sUsers = json_encode($jUsers);
file_put_contents('../data.json', $sUsers);


$_SESSION['jUser'] = $jUsers->users->$sUserId;


echo '{
    "status": 1 ,
    "message": "agent was updated"
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
