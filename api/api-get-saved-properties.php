<?php




session_start();

$sUserId = $_SESSION['jUser']->id;

if ($_SESSION['jUser']->id != $sUserId) {
    sendErrorMessage('user is not logged in or does not has this permition', __LINE__);
}



$sData = file_get_contents('../data.json');
$jData = json_decode($sData);



$aLikedProperties =  $jData->users->$sUserId->likedProperties;
// echo json_encode($aLikedProperties);

$aFullProperties = [];

foreach($jData->properties as $sKey => $jProp){
    foreach($aLikedProperties as $likedProp){
        if($sKey == $likedProp){
            // $aFullProperties->$sKey = $jProp;
            array_push($aFullProperties, $jProp);
        }
    }
}

echo json_encode($aFullProperties);


function sendErrorMessage($sMessage,  $iLine)
{
    echo '{
        "status": 0,
        "message": "' . $sMessage . '",
        "line": ' . $iLine . '
    }';

    exit;
}



