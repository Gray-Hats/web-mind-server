<?php

require_once('../config.php');
require('../helper.php');

$uuid = $_POST['uuid'];
echo json_encode($uuid);
// if($_FILES['image']) {

//     $result = uploadFile($_FILES, 'student/profile');

//     if($result) {

//         try {
//             $sql = "UPDATE students SET student_no='$studNo', lname='$lname', fname='$fname', mname='$mname' WHERE uuid='$uuid'";
            
//             $result = $db->query($sql);
//         }
//         catch (exception $e) {
//             $result = false;
//         }
        
//         echo json_encode($result);
//     }
//     else {
//         echo json_encode(false);
//     }
// }
// else {
//     echo json_encode($uuid);
// }

?>