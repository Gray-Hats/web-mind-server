<?php

require_once('../config.php');

$activity = $_POST['activity'];
$student = $_POST['student'];

$emparray = array();
try {
    $sql = "SELECT * FROM student_works WHERE activity='$activity' AND student='$student'";

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