<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$student = $_POST['student'];
$activity = $_POST['activity'];
$datePassed = $_POST['datePassed'];

$upload = uploadFile($_FILES, "student_works/$activity");

if($upload) {

    try {
        $sql = "INSERT INTO student_works VALUES('$uuid',?'$student','$activity','$datePassed','$upload->url','$upload->bucket_name')";
        
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