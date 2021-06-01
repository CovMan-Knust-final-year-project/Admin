<?php

    include_once '../database/config.php';
    include_once '../helpers/functions.php';

    if(isset($_POST['user_id'])){
        $user_id = $_POST["user_id"];

        $query = "SELECT * FROM scans t1 WHERE user_id = :id AND time_stamp = (SELECT MAX(time_stamp) FROM scans t2 WHERE t1.time_stamp = t2.time_stamp)";
    
        $statement = $con->prepare($query);
    
        $statement->execute(
            array(
                ":id" => $user_id,
            )
        );
        
        $results = $statement->fetch();

        $scans_array = array();
    
        //user is present in the system
        array_push($scans_array,array(
            "id"       => $results['id'],
            "date"     => dateFormat($results['date_scanned']),
            "time"     => $results['time_scanned'],
            "temperature" => $results['temperature'],
            "status"      => $results['status'],
        ));

        echo json_encode(array("Server response" => $scans_array));
        
    }
    else{
        echo "No such user"; //show 404
    }

?>
