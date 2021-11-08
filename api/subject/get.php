<?php

require_once('../config.php');

$uuid = $_POST['uuid'];

if($uuid) {
    try {
        $sql = "SELECT * FROM subjects WHERE uuid='$uuid'";
        
        $result = $db->query($sql);

        $emparray = array();
        while($row = $result->fetch_assoc()) {
            $emparray[] = $row;
        }
        echo json_encode($emparray);
    }
    catch (exception $e) {
        echo json_encode(false);
    }
    
}
else {
    echo json_encode(false);
}

?>