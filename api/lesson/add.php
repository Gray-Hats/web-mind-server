<?php

require_once('../config.php');
require('../helper.php');

$uuid = $_POST['uuid'];
$name = $_POST['name'];
$description = $_POST['description'];
$dateUploaded = $_POST['dateUploaded'];
$subject = $_POST['subject'];
$type = $_POST['type'];

$upload = uploadFile($_FILES, "lesson/$subject/$type");

if($upload) {

    try {
        $sql = "INSERT INTO lessons VALUES('$uuid','$name','$type','$description','$dateUploaded','$subject','$upload->url','$upload->bucket_name')";
        
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