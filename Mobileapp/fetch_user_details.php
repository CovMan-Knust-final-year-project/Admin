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
        
        $results = $statement->fetch();

        $user_array = array();
    
        //user is present in the system
        array_push($user_array,array(
            "user_id"    => $results{'id'},
            "org_id"     => $results['org_id'],
            "image"      => $results['image'],
            "first_name" => $results['first_name'],
            "last_name"  => $results['last_name'],
            "dob"        => $results['dob'],
            "level"      => $results['level'],
        ));

        echo json_encode(array("Server response" => $user_array));
        
    }
    else{
        echo "No phone number provided";
    }

?>
