<?php


$sPropId = $_GET['propId'];
$sUserId = $_GET['userId'];


session_start();

if($_SESSION['jUser']->id != $sUserId){
    sendErrorMessage('user is not logged in or does not has this permition', __LINE__);
}

echo $_SESSION['jUser']->id;
echo $sUserId;

$sData = file_get_contents('../data.json');
$jData = json_decode($sData);

array_push($jData->users->$sUserId->likedProperties, $sPropId);

file_put_contents( '../data.json',json_encode($jData));







function sendErrorMessage($sMessage,  $iLine)
{
    echo '{
        "status": 0,
        "message": "' . $sMessage . '",
        "line": ' . $iLine . '
    }';

    exit;
}