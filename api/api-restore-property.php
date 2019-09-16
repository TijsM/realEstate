<?php

// // ******* declaration and init *************************************************

$propId = $_GET['propId'];
$jData = json_decode(file_get_contents('../data.json'));

// echo json_encode($jData);
$toRestoreProp = $jData->deletedProperties->$propId;

// echo json_encode($toRestoreProp);
$agentId = $jData->deletedProperties->$propId->agentId;



//checking if it is the correct user
session_start();
$bPropExists = false;
$bCorrectAgent = false;

foreach($jData->deletedProperties as $sKey =>$jProp){
    if($propId == $sKey){
        $bPropExists = true;

        if($_SESSION['jUser']->id == $jProp->agentId){
            $bCorrectAgent = true;
        }
    }
}

if(!$bPropExists){
    sendErrorMessage('property was not found', __LINE__);
}

if(!$bCorrectAgent){
    sendErrorMessage('you are not the owner of this propertie', __line__);
}


//deleting from deletedProperties
unset($jData->deletedProperties->$propId);

// adding it back to the properties and to the agent

$jData->properties->$sKey = new stdClass();
$jData->properties->$sKey = $toRestoreProp;
$jData->users->$agentId->properties->$sKey = $toRestoreProp->name;

file_put_contents('../data.json', json_encode($jData, JSON_PRETTY_PRINT));


echo '{
    "status": 1,
    "message": " property was deleted"
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