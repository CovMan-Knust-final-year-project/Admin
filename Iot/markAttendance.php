<?php
    include_once '../database/config.php';

    if(isset($_POST['person_id']) && isset($_POST['org_id']) && isset($_POST['venue'])){
        $query = "INSERT INTO attendance (status, org_id, user_id, venue, date_marked, time_marked, time_stamp) 
            VALUES(1, :org_id, :user_id, :venue, curdate(),TIME_FORMAT(CURRENT_TIME(),'%h:%i:%s'), :time_stamp)";

        $statement = $con->prepare($query);
        $marked = $statement->execute(
            array(
                ":org_id"       => $_POST['org_id'],
                ":user_id"      => $_POST['person_id'],
                ":venue"        => $_POST['venue'],
                "time_stamp"    => date("Y-m-d H:i:s")
            )
        );

        if($marked){
            echo json_encode(
                array(
                    "status" => "success", 
                )
            );
        }
        else{
            echo json_encode(
                array(
                    "status" => "failed", 
                    "message" => "Something went wrong"
                )
            );
        }
    }
    else{
        echo "Provide details";
    }

?>