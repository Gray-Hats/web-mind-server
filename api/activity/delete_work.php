<?php

require_once('../config.php');

require('../helper.php');

$uuid = $_POST['uuid'];
$bucketName = $_POST['bucketName'];

$delete = deleteFile($bucketName);

if($delete) {
    try {
        $sql = "SELECT * FROM student_works WHERE uuid='$uuid'";
        
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