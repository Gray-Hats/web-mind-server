<?php

require_once('../config.php');

$activity = $_POST['activity'];

$emparray = array();
try {
    $sql = "SELECT student_works.*, activities.title, activities.date_uploaded, activities.close_date, activities.uri as activity_uri, subjects.title as subject_title, students.student_no, students.lname, students.fname, students.mname  FROM student_works INNER JOIN students ON student_works.student=students.uuid INNER JOIN activities ON student_works.activity=activities.uuid INNER JOIN subjects ON activities.subject=subjects.uuid WHERE student_works.activity='$activity' ORDER BY students.lname, students.fname, students.mname";

    $result = $db->query($sql);

    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        $emparray[] = $row;
    }
    echo json_encode($emparray);
}
catch (exception $e) {
    echo json_encode($emparray);
}

?>