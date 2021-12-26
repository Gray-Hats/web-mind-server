<?php

require_once('../config.php');
require '../../vendor/autoload.php';

if(!isset($_POST['uuid'])) {
    echo json_encode(false);
    return;
}

$uuid = $_POST['uuid'];
$ipAddress = $_POST['ipAddress'];
$browser = $_POST['browser'];

try {
    $sql = "UPDATE students SET ip='$ipAddress', browser='$browser' WHERE uuid='$uuid'";
    
    $result = $db->query($sql);
}
catch (exception $e) {
    $result = false;
}

echo json_encode($result);

?>