<?php

require_once('../config.php');

$emparray = array();
try {
    $sql = "SELECT * from notifications WHERE str_to_date(date_created, '%m/%d/%Y') > DATE_ADD(CURDATE(), INTERVAL -3 DAY) ORDER BY date_created DESC";

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