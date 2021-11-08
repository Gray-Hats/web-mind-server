<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$subject = $_POST['subject'];
$title = $_POST['title'];
$activityType = $_POST['activityType'];
$closeDate = $_POST['closeDate'];

if($uuid && $subject && $title) {

    try {
        $sql = "UPDATE activities SET subject='$subject', title='$title', type='$activityType', close_date='$closeDate' WHERE uuid='$uuid'";
        
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