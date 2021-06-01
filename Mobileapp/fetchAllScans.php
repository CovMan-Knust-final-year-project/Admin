<?php

    include_once '../database/config.php';
    include_once '../helpers/functions.php';

    if(isset($_POST['user_id'])){
        $user_id = $_POST["user_id"];

        $query = "SELECT * FROM scans WHERE user_id = :id";
        $statement = $con->prepare($query);
    
        $statement->execute(
            array(
                ":id" => $user_id,
            )
        );
        
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $scans_array = array();

        foreach ($result as $results){
            //user is present in the system
            array_push($scans_array,array(
                "id"       => $results['id'],
                "date"     => dateFormat($results['date_scanned']),
                "time"     => $results['time_scanned'],
                "temperature" => $results['temperature'],
                "status"      => $results['status'],
            ));
        }

        echo json_encode(array("Server response" => $scans_array));
        
    }
    else{
        echo "No such user"; //show 404
    }

?>
