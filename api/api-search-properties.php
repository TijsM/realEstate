<?php



//initializations and declerations
$sSearchTerm = $_GET['search'];
$aMatches = [];

$sData = file_get_contents('../data.json');
$jData = json_decode($sData);

//check if search is empty
if ($_GET['search'] == '') {
    foreach ($jData->properties as $skey => $jProp) {
        array_push($aMatches, $skey);
    }
} else {
    foreach ($jData->properties as $skey => $jProp) {
        if (strpos(strtolower($jData->properties->$skey->name), strtolower($sSearchTerm)) !== false) {
            array_push($aMatches, $skey);
        }
    }
}






echo json_encode($aMatches);
