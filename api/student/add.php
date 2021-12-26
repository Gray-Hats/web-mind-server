<?php

require_once('../config.php');

$uuid = $_POST['uuid'];
$studNo = $_POST['studNo'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$email = $_POST['email'];
$password = $_POST['password'];

if($uuid && $studNo && $lname && $fname) {

    try {
        $sql = "INSERT INTO students VALUES('$uuid','$studNo','$lname','$fname','$mname','$email','$password','','','')";
        
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