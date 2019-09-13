<?php

$propId = $_GET['propId'];

$jData = json_decode(file_get_contents('../data.json'));

// echo json_encode($jData);
$toDeleteProp = $jData->properties->$propId;

// echo json_encode($toDeleteProp);

$agentId = $jData->properties->$propId->agentId;


//deleting
unset($jData->properties->$propId);
unset($jData->users->$agentId->properties->$propId);

//adding to deleted folder
$jData->deletedProperties->$propId=new stdClass();
$jData->deletedProperties->$propId = $toDeleteProp;


file_put_contents('../data.json', json_encode($jData, JSON_PRETTY_PRINT));