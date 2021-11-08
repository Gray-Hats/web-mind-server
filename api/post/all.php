<?php

require_once('../config.php');

$emparray = array();
try {
    $sql = "SELECT * from posts ORDER by date_uploaded DESC";

    $result = $db->query($sql);

    while($row = $result->fetch_assoc()) {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
}
catch (exception $e) {
    echo json_encode($emparray);
}

?>