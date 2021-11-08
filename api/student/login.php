<?php

require_once('../config.php');

$studNo = $params['studNo'];
$password = $params['password'];

if($uuid && $password) {

    try {
        $sql = "SELECT * FROM students WHERE student_no='$studNo' AND password='$password'";
        
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