<?php

require_once('../config.php');
require('../helper.php');

$uuid = $_POST['uuid'];
$bucketName = $_POST['bucketName'];

if($_FILES['file']) {

    if($bucketName) {
        $result = deleteFile($bucketName);
    }

    $uploadRes = uploadFile($_FILES, 'student/profile');

    if($uploadRes) {

        try {
            $sql = "UPDATE students SET profile_url='$result->url', profile_bucket_name='$result->bucket_name' WHERE uuid='$uuid'";
            
            $result = $db->query($sql);
            
            if($result) {
                echo json_encode($uploadRes);
            }
            else {
                echo json_encode(false);
            }
        }
        catch (exception $e) {
            echo json_encode(false);
        }
    }
    else {
        echo json_encode(false);
    }
}
else {
    echo json_encode(false);
}

?>