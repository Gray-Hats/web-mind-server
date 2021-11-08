<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
        
if($uuid) {
    try {
        $sql = "DELETE FROM students WHERE uuid='$uuid'";
        
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