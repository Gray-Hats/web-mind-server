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

if($uuid && $subject && $title) {

    try {
        $sql = "UPDATE scores SET written='$written', written_total=$wTotal, written_ps=$wPercentage, written_ws=$wWeighted, performance='$performance', performance_total=$pTotal, performance_ps=$pPercentage, performance_ws=$pWeighted, initial_grade=$initialGrade, quarterly_grade=$quarterlyGrade WHERE student='$student' AND subject='$subject' AND quarter=$quarter";
        
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