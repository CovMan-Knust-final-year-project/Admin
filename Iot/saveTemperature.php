<?php
    include_once '../database/config.php';

    //positive cases are denoted by 1
    //negative cases are denoted by 0

    if(isset($_POST['person_id']) && isset($_POST['org_id']) && isset($_POST['venue']) && isset($_POST['temp'])){
        $query = "INSERT INTO scans (org_id, mount_point_id, status, user_id, temperature, date_scanned, time_scanned, time_stamp) 
            VALUES(:org_id, :mount_point_id, :status, :user_id, :temp, curdate(),TIME_FORMAT(CURRENT_TIME(),'%h:%i:%s'), :time_stamp)";

        $statement = $con->prepare($query);
        $marked = $statement->execute(
            array(
                ":org_id"          => $_POST['org_id'],
                ":mount_point_id"  => $_POST['venue'],
                ":status"          => $_POST['temp'] >= 37.00 ? 1 : 0,
                ":user_id"         => $_POST['person_id'],
                ":temp"            => $_POST['temp'],
                ":time_stamp"      => date("Y-m-d H:i:s")
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