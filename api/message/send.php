<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$sender = $_POST['sender'];
$message = $_POST['message'];
$dateSent = $_POST['dateSent'];
$student = $_POST['student'];

try {
    $sql = "INSERT INTO messages VALUES('$uuid','$sender','$message','$dateSent','$student')";
    
    $result = $db->query($sql);
}
catch (exception $e) {
    $result = false;
}     
    
echo json_encode($result);

?>