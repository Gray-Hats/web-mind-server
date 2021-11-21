<?php

require_once('../config.php');

if(!isset($_POST['student'])) {
    echo json_encode(false);
    return;
}

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

try {
    $sql = "UPDATE scores SET written='$written', written_total=$wTotal, written_ps=$wPercentage, written_ws=$wWeighted, performance='$performance', performance_total=$pTotal, performance_ps=$pPercentage, performance_ws=$pWeighted, initial_grade=$initialGrade, quarterly_grade=$quarterlyGrade WHERE student='$student' AND subject='$subject' AND quarter=$quarter";
    
    $result = $db->query($sql);
}
catch (exception $e) {
    $result = false;
}

echo json_encode($result);
?>