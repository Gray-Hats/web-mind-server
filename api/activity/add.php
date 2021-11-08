<?php

require_once('../config.php');
require('../helper.php');

$uuid = $_POST['uuid'];
$subject = $_POST['subject'];
$title = $_POST['title'];
$activityType = $_POST['activityType'];
$dateUploaded = $_POST['dateUploaded'];
$closeDate = $_POST['closeDate'];

$upload = uploadFile($_FILES, "activity/$subject");

if($upload) {

    try {
        $sql = "INSERT INTO activities VALUES('$uuid','$subject','$title','$activityType','$dateUploaded','$closeDate','$upload->url','$upload->bucket_name')";
        
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