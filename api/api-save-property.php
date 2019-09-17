<?php

session_start();
$sPropId = $_GET['propId'];
$sUserId = $_SESSION['jUser']->id;



// echo $_SESSION['jUser']->id;
// echo $sUserId;

$sData = file_get_contents('../data.json');
$jData = json_decode($sData);

foreach($jData->users->$sUserId->likedProperties as $likedProp){
    if($likedProp == $sPropId){
        echo '{
            "status": 2,
            "message": "Property was already saved"
        }';
    
        exit;
    }
}

array_push($jData->users->$sUserId->likedProperties, $sPropId);

file_put_contents( '../data.json',json_encode($jData));

 echo '{
    "status": 1,
    "message": "property was saved"
}';
