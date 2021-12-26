<?php

require_once('../config.php');
require '../../vendor/autoload.php';

if(!isset($_POST['email'])) {
    echo json_encode(false);
    return;
}

$code = $_POST['code'];
$emailTo = $_POST['email'];

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
    $mail->Body    = 'Hi!<br>
                    Someone tried to login to your Web Mind e-Learning Account.<br>
                    If this was you, please use this following code to log in:<br>
                    <h1>'.$code.'</h1><br>
                    If this wasn\'t you, please <b>reset your password</b> to secure your account.';

    $mail->AltBody = 'Hi! Someone tried to login to your Web Mind e-Learning Account. If this was you, please use this following code to log in:'.$code;

    $mail->send();
    echo json_encode(true);
} catch (Exception $e) {
    echo json_encode(false);
}

?>