<?php
    require('config.php');
    
    if(isset($_POST['action'])) {

        //GET ALL DATA
        if($_POST['action'] == 'all') {

            $emparray = array();
            try {
                $sql = "SELECT * FROM subjects ORDER BY title";
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

        //ADD SUBJECT
        else if($_POST['action'] == 'add') {

            $uuid = $_POST['uuid'];
            $code = $_POST['code'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $written = $_POST['written'];
            $performance = $_POST['performance'];

            if($uuid && $code && $title) {

                try {
                    $sql = "INSERT INTO subjects VALUES('$uuid','$code','$title','$description',$written,$performance)";
                    
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

        //UPDATE SUBJECT
        else if($_POST['action'] == 'update') {

            $uuid = $_POST['uuid'];
            $code = $_POST['code'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $written = $_POST['written'];
            $performance = $_POST['performance'];
        
            if($uuid && $studNo && $lname && $fname) {
        
                try {
                    $sql = "UPDATE subjects SET code='$code', title='$title', description='$description', written=$written, performance=$performance WHERE uuid='$uuid'";
                    
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

            $uuid = $_POST['uuid'];
        
            if($uuid) {
                try {
                    $sql = "DELETE FROM subjects WHERE uuid='$uuid'";
                    
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
        else if($_POST['action'] == 'get') {

            $uuid = $_POST['uuid'];

            if($uuid) {
                try {
                    $sql = "SELECT * FROM subjects WHERE uuid='$uuid'";
                    
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

        //GET SUBJECT COUNT
        else if($_POST['action'] == 'count') {

            try {
                $sql = "SELECT COUNT(uuid) as count from subjects";
                
                $result = $db->query($sql);
            }
            catch (exception $e) {
                $result = 0;
            }
                
            echo json_encode($result);
        }
    }
?>