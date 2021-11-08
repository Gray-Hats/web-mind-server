<?php
    require('config.php');
    
    if(isset($_POST['action'])) {

        //GET ALL DATA
        if($_POST['action'] == 'all') {

            $emparray = array();
            try {
                $sql = "SELECT * FROM students";
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

        //ADD STUDENTS
        else if($_POST['action'] == 'add') {

            $uuid = $_POST['uuid'];
            $studNo = $_POST['studNo'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];

            if($uuid && $studNo && $lname && $fname) {

                try {
                    $sql = "INSERT INTO students VALUES('$uuid','$studNo','$lname','$fname','$mname','student12345','')";
                    
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

        //UPDATE STUDENTS
        else if($_POST['action'] == 'update') {

            $uuid = $_POST['uuid'];
            $studNo = $_POST['studNo'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mname = $_POST['mname'];
        
            if($uuid && $studNo && $lname && $fname) {
        
                try {
                    $sql = "UPDATE students SET student_no='$studNo', lname='$lname', fname='$fname', mname='$mname' WHERE uuid='$uuid'";
                    
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

        //DELETE STUDENTS
        else if($_POST['action'] == 'delete') {

            $uuid = $_POST['uuid'];
        
            if($uuid) {
                try {
                    $sql = "DELETE FROM students WHERE uuid='$uuid'";
                    
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

        //GET STUENT BY UUID
        else if($_POST['action'] == 'get') {

            $uuid = $_POST['uuid'];

            if($uuid) {
                try {
                    $sql = "SELECT * FROM students WHERE uuid='$uuid'";
                    
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

        //GET STUDENT BY STUDENT NO AND PASSWORD
        else if($_POST['action'] == 'login') {

            $studNo = $params['studNo'];
            $password = $params['password'];
        
            if($uuid && $password) {
        
                try {
                    $sql = "SELECT * FROM students WHERE student_no='$studNo' AND password='$password'";
                    
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

        //GET STUDENT COUNT
        else if($_POST['action'] == 'count') {

            try {
                $sql = "SELECT COUNT(uuid) as count from students";
                
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

        //UPDATE PROFILE
        else if($_POST['action'] == 'upload_profile') {
            require('helper.php');
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
        }
    }
    else {
        echo json_encode(false);
    }
?>