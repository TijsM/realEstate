<?php

// // ******* declaration and init *************************************************

$propId = $_GET['propId'];
$jData = json_decode(file_get_contents('../data.json'));

// echo json_encode($jData);
$toDeleteProp = $jData->properties->$propId;

// echo json_encode($toDeleteProp);
$agentId = $jData->properties->$propId->agentId;


// // ******* vallidation *************************************************


//vallidating if the propertie belongs to the logged in user
session_start();
$bPropExists = false;
$bCorrectAgent = false;
foreach($jData->properties as $sKey => $jProp){
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



function sendErrorMessage($sMessage,  $iLine)
{
    echo '{
        "status": 0,
        "message": "' . $sMessage . '",
        "line": ' . $iLine . '
    }';

    exit;
}



// // ******* deleting the prop *************************************************



//deleting
unset($jData->properties->$propId);
unset($jData->users->$agentId->properties->$propId);

//adding to deleted folder
$jData->deletedProperties->$propId=new stdClass();
$jData->deletedProperties->$propId = $toDeleteProp;


file_put_contents('../data.json', json_encode($jData, JSON_PRETTY_PRINT));


echo '{
    "status": 1,
    "message": " property was deleted"
}';