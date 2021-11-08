<?php
    require('config.php');
    
    if(isset($_POST['action'])) {

        //GET ALL lessons
        if($_POST['action'] == 'all') {

            $emparray = array();
            try {
                $sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid ORDER BY date_uploaded DESC";
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

        //GET ALL modules
        else if($_POST['action'] == 'modules') {

            $emparray = array();
            try {
                $sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid WHERE type='module' ORDER BY date_uploaded DESC";

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

        //GET ALL medias
        else if($_POST['action'] == 'medias') {

            $emparray = array();
            try {
                $sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid WHERE type='media' ORDER BY date_uploaded DESC";

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

        //ADD Lesson
        else if($_POST['action'] == 'add') {

            require('helper.php');

            $uuid = $_POST['uuid'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $dateUploaded = $_POST['dateUploaded'];
            $subject = $_POST['subject'];
            $type = $_POST['type'];

            $upload = uploadFile($_FILES, "lesson/$subject/$type");

            if($upload) {

                try {
                    $sql = "INSERT INTO lessons VALUES('$uuid','$name','$type','$description','$dateUploaded','$subject','$upload->url','$upload->bucket_name')";
                    
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

        //UPDATE lesson
        else if($_POST['action'] == 'update') {

            $uuid = $_POST['uuid'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $subject = $_POST['subject'];
        
            try {
                $sql = "UPDATE lessons SET name='$name', description='$description', subject='$subject' WHERE uuid='$uuid'";
                
                $result = $db->query($sql);
            }
            catch (exception $e) {
                $result = false;
            }
            
            echo json_encode($result);

        }

        //DELETE lesson
        else if($_POST['action'] == 'delete') {

            require('helper.php');

            $uuid = $_POST['uuid'];
            $bucketName = $_POST['bucketName'];

            $delete = deleteFile($bucketName);
        
            if($delete) {
                try {
                    $sql = "DELETE FROM lessons WHERE uuid='$uuid'";
                    
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
    else {
        echo json_encode(false);
    }
?>