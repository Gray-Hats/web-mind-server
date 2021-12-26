<?php

require_once('../config.php');
require '../../vendor/autoload.php';

// if(!isset($_POST['email'])) {
//     echo json_encode(false);
//     return;
// }

// $code = $_POST['code'];
// $emailTo = $_POST['email'];

$code = '123456';
$emailTo = 'emersondalwampo1120@gmail.com';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$emailFrom = 'admin@webmind.com';

try {
    //Recipients
    $mail->setFrom($emailFrom, 'Web Mind');
    $mail->addAddress($emailTo);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Web Mind Verification Code';
    $mail->Body    = 'Hi!</br>
                    Someone tried to login to your Web Mind e-Learning Account.</br>
                    If this was you, please use this following code to log in:</br>
                    <h1>'.$code.'</h1></br>
                    If this wasn\'t you, please <b>reset your password</b> to secure your account.';

    $mail->AltBody = 'Hi! Someone tried to login to your Web Mind e-Learning Account. If this was you, please use this following code to log in:'.$code;

    $mail->send();
    echo 'Message has been sent.</br>From: '.$emailFrom.'</br>To:'.$emailTo;
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