<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$studNo = $_POST['studNo'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$email = $_POST['email'];

if($uuid && $studNo && $lname && $fname) {

    try {
        $sql = "UPDATE students SET student_no='$studNo', lname='$lname', fname='$fname', mname='$mname' email='$email' WHERE uuid='$uuid'";
        
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