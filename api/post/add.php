<?php

require_once('../config.php');
require('../helper.php');

$uuid = $_POST['uuid'];
$sender = $_POST['sender'];
$content = $_POST['content'];
$dateUploaded = $_POST['dateUploaded'];

if(isset($_FILES['file'])) {
    $upload = uploadFile($_FILES, "post");
}
else {
    $upload = new UploadResult();
    $upload->url = "";
    $upload->bucket_name = "";
}

if($upload) {
    try {
        $sql = "INSERT INTO posts VALUES('$uuid','$sender','$content','$dateUploaded','$upload->url','$upload->bucket_name')";
        
        $result = $db->query($sql);
    
        echo json_encode($result);
    }
    catch (exception $e) {
        echo json_encode(false);
    }   
}

?>