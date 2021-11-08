<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
        
try {
    $sql = "DELETE FROM messages WHERE uuid='$uuid'";
    
    $result = $db->query($sql);
}
catch (exception $e) {
    $result = false;
}
echo json_encode($result);

?>