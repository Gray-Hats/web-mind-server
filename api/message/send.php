<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$sender = $_POST['sender'];
$message = $_POST['message'];
$dateSent = $_POST['dateSent'];
$student = $_POST['student'];

try {
    if($student) {
        $sql = "INSERT INTO messages VALUES('$uuid','$sender','$message','$dateSent','$student')";
    }
    else {
        $sql = "INSERT INTO messages VALUES('$uuid','$sender','$message','$dateSent',null)";
    }
    
    $result = $db->query($sql);
    echo json_encode($sql);
}
catch (exception $e) {
    echo json_encode(false);
}     
    

?>