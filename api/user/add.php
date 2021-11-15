<?php

require_once('../config.php');

if(!isset($_POST['uuid'])) {
    echo json_encode(false);
    return;
}

$uuid = $_POST['uuid'];
$username = $_POST['username'];
$password = $_POST['password'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$type = $_POST['type'];

try {
    $sql = "INSERT INTO users VALUES ('$uuid', '$username', '$password', '$lname', '$fname', '$mname', '$type')";
    
    $result = $db->query($sql);
    
    echo json_encode($result);
}
catch (exception $e) {
    echo json_encode(false);
}

?>