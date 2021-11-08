<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$name = $_POST['name'];
$description = $_POST['description'];
$subject = $_POST['subject'];

try {
    $sql = "UPDATE lessons SET name='$name', description='$description', subject='$subject' WHERE uuid='$uuid'";
    
    $result = $db->query($sql);
}
catch (exception $e) {
    $result = false;
}

echo json_encode($result);

?>