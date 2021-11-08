<?php

require_once('../config.php');

$emparray = array();
try {
    $sql = "SELECT activities.*, subjects.title as subject_title FROM activities INNER JOIN subjects ON activities.subject=subjects.uuid ORDER BY activities.date_uploaded DESC";
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