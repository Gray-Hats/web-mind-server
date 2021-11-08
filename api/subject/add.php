<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$code = $_POST['code'];
$title = $_POST['title'];
$description = $_POST['description'];
$written = $_POST['written'];
$performance = $_POST['performance'];

if($uuid && $code && $title) {

    try {
        $sql = "INSERT INTO subjects VALUES('$uuid','$code','$title','$description',$written,$performance)";
        
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