<?php

//check if search is empty
if(!isset($_GET['search'])){
    echo '[]';
    exit;
}

//initializations and declerations
$sSearchTerm = $_GET['search'];
$aMatches = [];

$sData = file_get_contents('../data.json');
$jData = json_decode($sData);

//geting all the propertynames and putting them in an array
$aPropNames = [];
foreach($jData->properties as $sKey =>$sPropName){
    $sNameFromData = $jData->properties->$sKey->name;
  
    array_push($aPropNames, $sNameFromData);
    
}


// foreach($aPropNames as $propName){
//    if(strpos(strtolower($propName), strtolower($sSearchTerm))!== false){
//         array_push($aMatches,$propName);
//    }
// }

foreach($jData->properties as $skey => $jProp){
    if(strpos(strtolower($jData->properties->$skey->name), strtolower($sSearchTerm))!== false){
        // array_push($aMatches,$skey);
        $jsonKeyVal = new stdClass();
        $jsonKeyVal->$skey = $jProp;
        array_push($aMatches,$jProp);
   }
}


echo json_encode($aMatches);