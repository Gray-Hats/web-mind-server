<?php

require_once('../config.php');

$subject = $_POST['subject'];
$quarter = $_POST['quarter'];
$written = "0,0,0,0";
$performance = "0,0,0,0";

try {
    $sql = "UPDATE weights SET written='$written', performance='$performance' WHERE subject='$subject' AND quarter=$quarter";

    $result = $db->query($sql);

    echo json_encode($sql);
}
catch (exception $e) {
    echo json_encode(false);
}

?>