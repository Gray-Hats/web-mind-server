<?php

require_once('../config.php');

$emparray = array();
try {
    $sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid WHERE type='media' ORDER BY date_uploaded DESC";

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