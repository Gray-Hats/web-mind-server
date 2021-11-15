<?php

require_once('../config.php');

if(!isset($_POST['uuid'])) {
    echo json_encode(false);
    return;
}

$uuid = $_POST['uuid'];
$password = $_POST['password'];

if($uuid && $password) {

    try {
        $sql = "UPDATE students SET password='$password' WHERE uuid='$uuid'";
        
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