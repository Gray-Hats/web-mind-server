<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$type = $_POST['type'];
$content = $_POST['content'];
$dateCreated = $_POST['dateCreated'];

try {
    $sql = "INSERT INTO notifications VALUES('$uuid','$type','$content','$dateCreated')";
    
    $result = $db->query($sql);
}
catch (exception $e) {
    $result = false;
}
echo json_encode($result);

?>