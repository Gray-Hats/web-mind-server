<?php

require_once('../config.php');

$emparray = array();
try {
    $sql = "SELECT * from messages ORDER BY date_sent";
    $result = $db->query($sql);

    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
}
catch (exception $e) {
    echo json_encode($emparray);
}

?>