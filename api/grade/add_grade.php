<?php

require_once('../config.php');

$student = $_POST['student'];
$subject = $_POST['subject'];
$quarter = $_POST['quarter'];
$written = $_POST['written'];
$wTotal = $_POST['wTotal'];
$wPercentage = $_POST['wPercentage'];
$wWeighted = $_POST['wWeighted'];
$performance = $_POST['performance'];
$pTotal = $_POST['pTotal'];
$pPercentage = $_POST['pPercentage'];
$pWeighted = $_POST['pWeighted'];
$initialGrade = $_POST['initialGrade'];
$quarterlyGrade = $_POST['quarterlyGrade'];

$upload = uploadFile($_FILES, "student_works/$activity");

if($upload) {

    try {
        $sql = "INSERT INTO scores VALUES('$student','$subject',$quarter,'$written',$wTotal,$wPercentage,$wWeighted,'$performance',$pTotal,$pPercentage,$pWeighted,$initialGrade,$quarterlyGrade)";
        
        $result = $db->query($sql);
    }
    catch (exception $e) {
        $result = false;
    }
    
    echo json_encode($result);
}
else {
    echo json_encode(false);
}

?>