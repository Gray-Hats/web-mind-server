<?php
    require('config.php');
    
    //get all posts
    if(isset($_POST['action'])) {

        //GET ALL NOTIFICATIONS
        if($_POST['action'] == 'all') {

            $emparray = array();
            try {
                $sql = "SELECT * from posts ORDER by date_uploaded DESC";

                $result = $db->query($sql);
            
                while($row = $result->fetch_assoc()) {
                    $emparray[] = $row;
                }
                echo json_encode($emparray);
            }
            catch (exception $e) {
                echo json_encode($emparray);
            }

        }

        //add posts
        else if($_POST['action'] == 'add') {

            require('helper.php');

            $uuid = $_POST['uuid'];
            $sender = $_POST['sender'];
            $content = $_POST['content'];
            $dateUploaded = $_POST['dateUploaded'];

            if(isset($_FILES['file'])) {
                $upload = uploadFile($_FILES, "post");
            }
            else {
                $upload = new UploadResult();
                $upload->url = "";
                $upload->bucket_name = "";
            }

            if($upload) {
                try {
                    $sql = "INSERT INTO posts VALUES('$uuid','$sender','$content','$dateUploaded','$upload->url','$upload->bucket_name')";
                    
                    $result = $db->query($sql);
                
                    echo json_encode($result);
                }
                catch (exception $e) {
                    echo json_encode(false);
                }   
            }

        }

        //delete post
        else if($_POST['action'] == 'delete') {

            require('helper.php');

            $uuid = $_POST['uuid'];
            $bucketName = $_POST['bucketName'];

            $delete = deleteFile($bucketName);
        
            if($delete) {
                try {
                    $sql = "DELETE FROM posts WHERE uuid='$uuid'";
                    
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