<?php

require_once('../config.php');
require '../../vendor/autoload.php';

// if(!isset($_POST['uuid'])) {
//     echo json_encode(false);
//     return;
// }

// $uuid = $_POST['uuid'];
// $ipAddress = $_POST['ipAddress'];
// $browser = $_POST['browser'];
// $email = $_POST['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    // $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'user@example.com';                     //SMTP username
    // $mail->Password   = 'secret';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('edalwampo20@gmail.com', 'Mailer');
    $mail->addAddress('emersondalwampo1120@gmail.com.com');               //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// if($uuid && $password) {

//     try {
//         $sql = "UPDATE students SET ip='$ipAddress', browser='$browser' WHERE uuid='$uuid'";
        
//         $result = $db->query($sql);
//     }
//     catch (exception $e) {
//         $result = false;
//     }
    
//     echo json_encode($result);
// }
// else {
//     echo json_encode(false);
// }

?>