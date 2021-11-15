<?php

require_once('../config.php');

$uuid = $_POST['uuid'];

$uuid = $_POST['uuid'];
$username = $_POST['username'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$type = $_POST['type'];

try {
    $sql = "UPDATE users SET username='$username', lname='$lname', fname='$fname', mname='$mname', type='$type' WHERE uuid='$uuid' ";
    
    $result = $db->query($sql);
    
    echo json_encode($result);
}
catch (exception $e) {
    echo json_encode(false);
}

?>