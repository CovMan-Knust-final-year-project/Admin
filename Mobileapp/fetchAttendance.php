<?php

    include_once '../database/config.php';
    include_once '../helpers/functions.php';

    if(isset($_POST['user_id'])){
        $user_id = $_POST["user_id"];

        $query = "SELECT * FROM attendance WHERE user_id = :id AND status = 1";
        $statement = $con->prepare($query);
    
        $statement->execute(
            array(
                ":id" => $user_id,
            )
        );
        
        $results = $statement->fetch();

        $attendance_array = array();
    
        //user is present in the system
        array_push($attendance_array,array(
            "venue"    => fetchMountPointDetailsFromID($con,$results['venue'],'venue'),
            "date"     => dateFormat($results['date_marked']),
            "time"     => $results['time_marked'],
        ));

        echo json_encode(array("Server response" => $attendance_array));
        
    }
    else{
        echo "No such user"; //show 404
    }

?>
