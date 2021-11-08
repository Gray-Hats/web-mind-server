<?php
    require('config.php');
    
    if(isset($_POST['action'])) {

        //GET NOTIFICATIONS
        if($_POST['action'] == 'current') {

            $emparray = array();
            try {
                $sql = "SELECT * from notifications WHERE str_to_date(date_created, '%m/%d/%Y') > DATE_ADD(CURDATE(), INTERVAL -3 DAY) ORDER BY date_created DESC";

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

        //GET NOTIFICATION COUNTS
        else if($_POST['action'] == 'count') {

            $emparray = array();
            try {
                $sql = "SELECT COUNT(uuid) as count from notifications WHERE date_created > date_add(CURRENT_DATE, INTERVAL -3 DAY) ORDER BY date_created DESC";
                
                $result = $db->query($sql);

                $emparray = array();
                if($result){
                    while($row = $result->fetch_assoc()) {
                        $emparray[] = $row;
                    }
                }
                echo json_encode($emparray);
            }
            catch (exception $e) {
               echo json_encode(false);
            }

        }

        //ADD NOTIFICATION
        else if($_POST['action'] == 'add') {

            $uuid = $_POST['uuid'];
            $type = $_POST['type'];
            $content = $_POST['content'];
            $dateCreated = $_POST['dateCreated'];
        
            try {
                $sql = "INSERT INTO notifications VALUES('$uuid','$type','$content','$dateCreated')";
                
                $result = $db->query($sql);
            }
            catch (exception $e) {
                $result = false;
            }
            echo json_encode($result);

        }
    }
    else {
        echo json_encode(false);
    }
?>