<?php

session_start();

$sAgentId='';

if($_SESSION){
    $sAgentId = $_SESSION['jUser']->id;
}

else{
    sendErrorMessage('user not logged in',__LINE__);
}

$sData = file_get_contents('../data.json');
$jData = json_decode($sData);



// if(!(isset($jData->deletedProperties->$sAgentId))){
//     sendErrorMessage("You don't have any deleted properties yet",__LINE__);
// }

$aDeletedPropertiesOfAgent = [];

foreach($jData->deletedProperties as $sPropKey => $jProperty)
{
    if($jProperty->agentId == $sAgentId){
        array_push($aDeletedPropertiesOfAgent, $jProperty);
    }
}

if(count($aDeletedPropertiesOfAgent) == 0){
    sendErrorMessage('you do not have any deleted properties yet',__LINE__);
}


echo json_encode($aDeletedPropertiesOfAgent);


function sendErrorMessage($sMessage,  $iLine)
{
    echo '{
        "status": 0,
        "message": "' . $sMessage . '",
        "line": ' . $iLine . '
    }';

    exit;
}

