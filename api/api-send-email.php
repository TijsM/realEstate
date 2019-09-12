<?php

$sAgentAddress = $_POST['mailAddress'];
$sContent = $_POST['content'];



// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../email-files/PHPMailer.php';
require '../email-files/Exception.php';
require '../email-files/SMTP.php';

// Instantiation and passing true enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'tijs.development@gmail.com';            // your email address from which the mail wil be sent
    $mail->Password   = 'Password_1111';          //  password of the above mail address
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, ssl also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('tijs.martens@development.com', 'name'); //email adress which wil sent the mail
    $mail->addAddress("$sAgentAddress", 'Houser'); // email address which will receive the mail
    // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content

    $mail->isHTML(true);                                  // makes sure your email is formatted in html
    $mail->Subject = 'confirmation of the test project';


    // **** putting link in the mail so the user can confirm the account  
    $mail->Body    = "
    <h1>You have a new message in concern of your property</h1>

    <p>$sContent</p>
    " ;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo '{
        "status": 1 ,
        "message": "The email was sent"
    }';
} catch (Exception $e) {
    echo '
    {
        "status": 0 ,
        "message": "something went wrong"
    }';
}