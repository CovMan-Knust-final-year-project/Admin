<?php

    include_once '../database/config.php';
    include_once '../helpers/functions.php';

    if(isset($_POST['user_id'])){
        $user_id        = $_POST['user_id'];
        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $dob            = $_POST['dob'];
        $phone_number   = $_POST['phone_number'];
        $level          = $_POST['level'];

        $query      = "UPDATE users SET first_name = :fname, last_name = :lname, dob = :dob, phone_number = :phone_number, level = :level WHERE id = :user_id";
        $statement  = $con->prepare($query);

        $has_edited = $statement->execute(
            array(
                ":fname"        => $first_name,
                ":lname"        => $last_name,
                ":dob"          => $dob,
                ":phone_number" => $phone_number,
                ":level"        => $level,
                ":user_id"      => $user_id,
            )
        );

        $array_ = array();

        if($has_edited){
            array_push($array_,array(
                "status" => "200",
                "message" => "success",
            ));
    
            echo json_encode(array("Server response" => $array_));
        }
        else{
            array_push($array_,array(
                "status" => "400",
                "message" => "Something went wrong",
            ));
    
            echo json_encode(array("Server response" => $array_));
        }
    }
    else{
        //show 404 page
    }
?>