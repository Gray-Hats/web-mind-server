<?php
    require('config.php');
    
    if(isset($_POST['action'])) {

        //GET ALL DATA
        if($_POST['action'] == 'all') {

            $emparray = array();
            try {
                $sql = "SELECT activities.*, subjects.title as subject_title FROM activities INNER JOIN subjects ON activities.subject=subjects.uuid ORDER BY activities.date_uploaded DESC";
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

        }

        //GET ALL STUDENT WORKS
        else if($_POST['action'] == 'all_works') {

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

        }

        //GET ALL STUDENT WORKS
        else if($_POST['action'] == 'get_work') {

            $activity = $_POST['activity'];
            $student = $_POST['student'];

            $emparray = array();
            try {
                $sql = "SELECT * FROM student_works WHERE activity='$activity' AND student='$student'";

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

        }

        //ADD ACTIVITY
        else if($_POST['action'] == 'add') {

            require('helper.php');

            $uuid = $_POST['uuid'];
            $subject = $_POST['subject'];
            $title = $_POST['title'];
            $activityType = $_POST['activityType'];
            $dateUploaded = $_POST['dateUploaded'];
            $closeDate = $_POST['closeDate'];

            $upload = uploadFile($_FILES, "activity/$subject");

            if($upload) {

                try {
                    $sql = "INSERT INTO activities VALUES('$uuid','$subject','$title','$activityType','$dateUploaded','$closeDate','$upload->url','$upload->bucket_name')";
                    
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

        }

        //SUBMIT ACTIVITY
        else if($_POST['action'] == 'submit') {

            $uuid = $_POST['uuid'];
            $student = $_POST['student'];
            $activity = $_POST['activity'];
            $datePassed = $_POST['datePassed'];

            $upload = uploadFile($_FILES, "student_works/$activity");
        
            if($upload) {
        
                try {
                    $sql = "INSERT INTO student_works VALUES('$uuid',?'$student','$activity','$datePassed','$upload->url','$upload->bucket_name')";
                    
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

        }

        //UPDATE ACTIVITY
        else if($_POST['action'] == 'update') {

            $uuid = $_POST['uuid'];
            $subject = $_POST['subject'];
            $title = $_POST['title'];
            $activityType = $_POST['activityType'];
            $closeDate = $_POST['closeDate'];
        
            if($uuid && $subject && $title) {
        
                try {
                    $sql = "UPDATE activities SET subject='$subject', title='$title', type='$activityType', close_date='$closeDate' WHERE uuid='$uuid'";
                    
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

        }

        //DELETE SUBJECT
        else if($_POST['action'] == 'delete') {

            require('helper.php');

            $uuid = $_POST['uuid'];
            $bucketName = $_POST['bucketName'];

            $delete = deleteFile($bucketName);
        
            if($delete) {
                try {
                    $sql = "DELETE FROM activities WHERE uuid='$uuid'";
                    
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

        }

        //GET SUBJECT BY UUID
        else if($_POST['action'] == 'delete_work') {

            require('helper.php');

            $uuid = $_POST['uuid'];
            $bucketName = $_POST['bucketName'];

            $delete = deleteFile($bucketName);

            if($delete) {
                try {
                    $sql = "SELECT * FROM student_works WHERE uuid='$uuid'";
                    
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

        }
    }
?>