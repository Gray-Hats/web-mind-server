<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$code = $_POST['code'];
$title = $_POST['title'];
$description = $_POST['description'];
$written = $_POST['written'];
$performance = $_POST['performance'];

if($uuid && $studNo && $lname && $fname) {

    try {
        $sql = "UPDATE subjects SET code='$code', title='$title', description='$description', written=$written, performance=$performance WHERE uuid='$uuid'";
        
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