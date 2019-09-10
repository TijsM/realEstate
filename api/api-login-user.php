<?php

session_start();

//check if user is already logged in
// if ($_SESSION['sUserId'] ){
//     echo '{
//         "status": 1,
//         "message": "user was already logged in"
//     }';
//     exit;
// }


//check if mail is filled in
if (empty($_POST['email'])){
    sendErrorMessage('email address missing', __LINE__);
}

if (empty($_POST['password'])){
    sendErrorMessage('missing password', __LINE__);
}

// validate if email is good format
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    sendErrorMessage('the mail has not the correct format', __line__);
}

//validate the length of the password
if (strlen($_POST['password']) < 6){
    sendErrorMessage('password to sort, must be at least 6 characters long', __LINE__);
}

//validate the length of the password
if (strlen($_POST['password']) > 50){
    sendErrorMessage('password too long, must be at least 50 chars long', __line__);    
}

//validation in json file
$sData = file_get_contents('../data.json');
$jData = json_decode($sData);

foreach($jData->users as $sKey => $jProp){
    if($jProp->email == $_POST['email']){

        if($jProp->password == $_POST['password']){
          
            $_SESSION['jUser'] = $jProp;
        
            echo '{
                "status": 1,
                "message": "the user was logged in succesfully"
            }';

            ////test purposes
            // echo '<div></div>';
            // $sTestSession = $_SESSION['sUserId'];
            // echo "in session: $sTestSession";
            exit;
        }
        else{
            sendErrorMessage('password or mail not correct', __LINE__);
        }
    }
}


function sendErrorMessage($sMessage,  $iLine){
    echo '{
        "status": 0,
        "message": "'.$sMessage.'",
        "line": '.$iLine.'
    }';

    exit;
}