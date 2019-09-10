<?php

$sUserId = $_POST['userId'];

//checking if the user is logged in
session_start();
if ($_SESSION['jUser']->id != $sUserId) {
    sendErrorMessage('user is not logged in or does not has this permition', __LINE__);
}


$sData = file_get_contents('../data.json');
$jData = json_decode($sData);

// echo $sData;

unset($jData->users->$sUserId);

$sData = json_encode($jData);
file_put_contents('../data.json', $sData);

echo '{
    "status": 1 ,
    "message": "user was deleted"
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
