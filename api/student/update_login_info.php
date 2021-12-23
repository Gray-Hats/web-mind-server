<?php

require_once('../config.php');
require('../../class/class.phpmailer.php');

if(!isset($_POST['uuid'])) {
    echo json_encode(false);
    return;
}

$uuid = $_POST['uuid'];
$ipAddress = $_POST['ipAddress'];
$browser = $_POST['browser'];
$email = $_POST['email'];

if($uuid && $password) {

    try {
        $sql = "UPDATE students SET ip='$ipAddress', browser='$browser' WHERE uuid='$uuid'";
        
        $result = $db->query($sql);

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtpout.secureserver.net';
        $mail->Port = '80';
        $mail->SMTPAuth = true;
        $mail->Username = 'xxxxxxxxxxxxxx';
        $mail->Password = 'xxxxxxxxxxxxxx';
        $mail->SMTPSecure = '';
        $mail->From = 'edalwampo20@gmail.com';
        $mail->FromName = 'Webslesson';
        $mail->AddAddress('emersondalwampo1120@gmail.com');
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = 'Verification code for Verify Your Email Address';
     
        $message_body = '
        <p>For verify your email address, enter this verification code when prompted: <b>AAAA</b>.</p>
        <p>Sincerely,</p>
        <p>Webslesson.info</p>
        ';
        $mail->Body = $message_body;

        $mail->Send();
     
        if($mail->Send())
        {
            $result = 'Sent Success';
        }
        else
        {
            $result = 'Failed to Sent';
        }
    }
    catch (exception $e) {
        $result = false;
    }
    
    echo json_encode($result);
}
else {
    echo json_encode(false);
}

?>