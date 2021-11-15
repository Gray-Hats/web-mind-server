<?php

require_once('../config.php');

$subject = $_POST['subject'];
$quarter = $_POST['quarter'];
$written = $_POST['written'];
$performance = $_POST['performance'];

try {
    $sql = "UPDATE weights SET written='$written', performance='$performance' WHERE subject='$subject' AND quarter=$quarter";

    $result = $db->query($sql);

    echo json_encode($result);
}
catch (exception $e) {
    echo json_encode(false);
}

?>