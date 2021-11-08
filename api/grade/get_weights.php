<?php

require_once('../config.php');

$subject = $_POST['subject'];
$quarter = $_POST['quarter'];

$emparray = array();
try {
    $sql = "SELECT * FROM weights WHERE subject='$subject' AND quarter=$quarter";

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