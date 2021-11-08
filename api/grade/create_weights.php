<?php

require_once('../config.php');

$subject = $_POST['subject'];
$quarter = $_POST['quarter'];
$written = "0,0,0,0";
$performance = "0,0,0,0";

try {
    $sql = "INSERT INTO weights VALUES('$subject',$quarter,'$written','$performance')";
    $result = $db->query($sql);

    echo json_encode($result);
}
catch (exception $e) {
    echo json_encode(false);
}

?>