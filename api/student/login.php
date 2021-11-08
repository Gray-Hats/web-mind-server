<?php

require_once('../config.php');

$studNo = $_POST['studNo'];
$password = $_POST['password'];

if($studNo && $password) {

    try {
        $sql = "SELECT * FROM students WHERE student_no='$studNo' AND password='$password'";
        
        $result = $db->query($sql);

        $emparray = array();
        while($row = $result->fetch_assoc()) {
            $emparray[] = $row;
        }
        echo json_encode($emparray);
    }
    catch (exception $e) {
        echo json_encode(false);
    }
}
else {
    echo json_encode(false);
}

?>