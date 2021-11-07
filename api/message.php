<?php
    require('config.php');
    
    if(isset($_POST['action'])) {

        //GET ALL messages
        if($_POST['action'] == 'all') {

            $emparray = array();
            try {
                $sql = "SELECT * from messages ORDER BY date_sent";
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

        //send message
        else if($_POST['action'] == 'send') {

            $uuid = $_POST['uuid'];
            $sender = $_POST['sender'];
            $message = $_POST['message'];
            $dateSent = $_POST['dateSent'];
            $student = $_POST['student'];

            try {
                $sql = "INSERT INTO messages VALUES('$uuid','$sender','$message','$dateSent','$student')";
                
                $result = $db->query($sql);
            }
            catch (exception $e) {
                $result = false;
            }     
                
            echo json_encode($result);

        }

        //DELETE lesson
        else if($_POST['action'] == 'delete') {

            $uuid = $_POST['uuid'];
        
            try {
                $sql = "DELETE FROM messages WHERE uuid='$uuid'";
                
                $result = $db->query($sql);
            }
            catch (exception $e) {
                $result = false;
            }
            echo json_encode($result);

        }
    }
?>