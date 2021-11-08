<?php

require_once('../config.php');

$emparray = array();
try {
    $sql = "SELECT COUNT(uuid) as count from notifications WHERE date_created > date_add(CURRENT_DATE, INTERVAL -3 DAY) ORDER BY date_created DESC";
    
    $result = $db->query($sql);

    $emparray = array();
    if($result){
        while($row = $result->fetch_assoc()) {
            $emparray[] = $row;
        }
    }
    echo json_encode($emparray);
}
catch (exception $e) {
    echo json_encode(false);
}

?>