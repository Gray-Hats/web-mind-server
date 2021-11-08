<?php

require_once('../config.php');

$student = $_POST['student'];
$subject = $_POST['subject'];
$quarter = $_POST['quarter'];

$emparray = array();
try {
    $sql = "SELECT * FROM scores WHERE student='$student' AND subject='$subject' AND quarter=$quarter";
    
    $result = $db->query($sql);
    
    while($row = $result->fetch_assoc()) {
        $emparray[] = $row;
    }
}
catch (exception $e) {}

echo json_encode($emparray);

?>