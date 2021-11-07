<?php
    require('config.php');
    
    if(isset($_POST['action'])) {

        //create weights
        if($_POST['action'] == 'create_weights') {

            $subject = $_POST['subject'];
            $quarter = $_POST['quarter'];
            $written = "0,0,0,0";
            $performance = "0,0,0,0";

            try {
                $sql = "INSERT INTO weights VALUES('$subject',$quarter,'$written','$performance')";
                $result = $db->query($sql);
            
                echo json_encode($result);
            }
            catch (exception $e) {
                echo json_encode(false);
            }

        }

        //update subject weights
        else if($_POST['action'] == 'update_weights') {

            $subject = $_POST['subject'];
            $quarter = $_POST['quarter'];
            $written = "0,0,0,0";
            $performance = "0,0,0,0";

            try {
                $sql = "UPDATE weights SET written='$written', performance='$performance' WHERE subject='$subject' AND quarter=$quarter";

                $result = $db->query($sql);
            
                echo json_encode($result);
            }
            catch (exception $e) {
                echo json_encode(false);
            }

        }

        //get subject weights
        else if($_POST['action'] == 'get_weights') {

            $subject = $_POST['subject'];
            $quarter = $_POST['quarter'];

            $emparray = array();
            try {
                $sql = "SELECT * FROM weights WHERE subject='$subject' AND quarter=$quarter";

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

        //get grade
        else if($_POST['action'] == 'get_grade') {

            $student = $_POST['student'];
            $subject = $_POST['subject'];
            $quarter = $_POST['quarter'];

            $emparray = array();
            try {
                $sql = "SELECT * FROM scores WHERE student='$student' AND subject='$subject' AND quarter=$quarter";
                
                $result = $db->query($sql);
                
                while($row = $result->fetch_assoc()) {
                    $emparray[] = $row;
                }
            }
            catch (exception $e) {}

            echo json_encode($emparray);

        }

        //add grade
        else if($_POST['action'] == 'add_grade') {

            $student = $_POST['student'];
            $subject = $_POST['subject'];
            $quarter = $_POST['quarter'];
            $written = $_POST['written'];
            $wTotal = $_POST['wTotal'];
            $wPercentage = $_POST['wPercentage'];
            $wWeighted = $_POST['wWeighted'];
            $performace = $_POST['performace'];
            $pTotal = $_POST['pTotal'];
            $pPercentage = $_POST['pPercentage'];
            $pWeighted = $_POST['pWeighted'];
            $initialGrade = $_POST['initialGrade'];
            $quarterlyGrade = $_POST['quarterlyGrade'];

            $upload = uploadFile($_FILES, "student_works/$activity");
        
            if($upload) {
        
                try {
                    $sql = "INSERT INTO scores VALUES('$student','$subject',$quarter,'$written',$wTotal,$wPercentage,$wWeighted,'$performace',$pTotal,$pPercentage,$pWeighted,$initialGrade,$quarterlyGrade)";
                    
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

        //update grade
        else if($_POST['action'] == 'update_grade') {

            $student = $_POST['student'];
            $subject = $_POST['subject'];
            $quarter = $_POST['quarter'];
            $written = $_POST['written'];
            $wTotal = $_POST['wTotal'];
            $wPercentage = $_POST['wPercentage'];
            $wWeighted = $_POST['wWeighted'];
            $performace = $_POST['performace'];
            $pTotal = $_POST['pTotal'];
            $pPercentage = $_POST['pPercentage'];
            $pWeighted = $_POST['pWeighted'];
            $initialGrade = $_POST['initialGrade'];
            $quarterlyGrade = $_POST['quarterlyGrade'];
        
            if($uuid && $subject && $title) {
        
                try {
                    $sql = "UPDATE scores SET written='$written', written_total=$wTotal, written_ps=$wPercentage, written_ws=$wWeighted, performance='$performace', performance_total=$pTotal, performance_ps=$pPercentage, performance_ws=$pWeighted, initial_grade=$initialGrade, quarterly_grade=$quarterlyGrade WHERE student='$student' AND subject='$subject' AND quarter=$quarter";
                    
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