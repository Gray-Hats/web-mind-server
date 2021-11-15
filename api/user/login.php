<?php

require_once('../config.php');

if(!isset($_POST['username'])) {
    echo json_encode(false);
    return;
}

$username = $_POST['username'];
$password = $_POST['password'];

try {
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    
    $result = $db->query($sql);
    
    $emparray = array();
    while($row = $result->fetch_assoc()) {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
}
catch (exception $e) {
    echo json_encode([]);
}


?>