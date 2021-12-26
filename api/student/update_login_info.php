<?php

require_once('../config.php');
require '../../vendor/autoload.php';

if(!isset($_POST['uuid'])) {
    echo json_encode(false);
    return;
}

$uuid = $_POST['uuid'];
$ipAddress = $_POST['ipAddress'];
$browser = $_POST['browser'];
$email = $_POST['email'];


use \Mailjet\Resources;
$mj = new \Mailjet\Client('3a840627baeb8107ea25b067894b89d9','c6bf678eca112784bf73b84c53544a25',true,['version' => 'v3.1']);
$body = [
'Messages' => [
    [
    'From' => [
        'Email' => "edalwampo20@gmail.com",
        'Name' => "Emerson"
    ],
    'To' => [
        [
        'Email' => "emersondalwampo1120@gmail.com",
        'Name' => "Emerson"
        ]
    ],
    'Subject' => "Greetings from Mailjet.",
    'TextPart' => "My first Mailjet email",
    'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
    'CustomID' => "AppGettingStartedTest"
    ]
]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && var_dump($response->getData());

if($uuid && $password) {

    try {
        $sql = "UPDATE students SET ip='$ipAddress', browser='$browser' WHERE uuid='$uuid'";
        
        $result = $db->query($sql);
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