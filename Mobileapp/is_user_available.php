<?php

    include_once '../database/config.php';
    include_once '../helpers/functions.php';

    if(isset($_POST['phone_number'])){
        $phone_number = $_POST["phone_number"];

        $query = "SELECT * FROM users WHERE phone_number = :phone_number AND status = 1";
        $statement = $con->prepare($query);
    
        $statement->execute(
            array(
                ":phone_number" => $phone_number,
            )
        );
    
        $count = $statement->rowCount();
    
        $presence_array = array();
    
        if($count == 0){
            //user is not present in the system 
            array_push($presence_array,array(
                "status" => "400",
                "message" => "user absent",
            ));
    
            echo json_encode(array("Server response" => $presence_array));
    
        }
        else{
            //user is present in the system
            array_push($presence_array,array(
                "status" => "200",
                "message" => "user present",
            ));
    
            echo json_encode(array("Server response" => $presence_array));
        }
    }
    else{
        echo "No phone number provided";
    }

?>
