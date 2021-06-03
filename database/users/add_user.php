<?php
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    date_default_timezone_set("Africa/Accra");

    $first_name     = $_POST["f_name"];
    $last_name      = $_POST["l_name"];
    $dob            = $_POST["dob"];      
    $phone_number   = $_POST["phone_number"];  
    $level          = $_POST["level"];  

    $removed_brackets = removeBracketsFromPhone($phone_number);

    $targetPath = "";

    if (is_array($_FILES)) {
        if (is_uploaded_file($_FILES['your_picture']['tmp_name'])) {
            $sourcePath = $_FILES['your_picture']['tmp_name'];
            $targetPath = "../../assets/img/members/" . $_FILES['your_picture']['name'];
            if (move_uploaded_file($sourcePath, $targetPath)) {
            }
        }
    }

    //status( 0 means deleted, 1 means active)
    $query = "INSERT INTO users(org_id, status, image, first_name, last_name, dob, phone_number, level, date_created, time_created, time_stamp) 
        VALUES (:org_id, 1, :image, :fname, :lname, :dob, :phone_number, :level, curdate(),TIME_FORMAT(CURRENT_TIME(),'%h:%i:%s'), :timestamp_)";
    $statement = $con->prepare($query);

    $count_query = "SELECT * FROM users WHERE status = 1 AND phone_number = :number_";
    $count_statement = $con->prepare($count_query);
    $count_statement->execute(
        array(
            ":number_"  => $removed_brackets,
        )
    );
    if($count_statement->rowCount() == 0){
        $added = $statement->execute(
            array(
                ":org_id"       => $_SESSION['id'],
                ":image"        => $targetPath != null ? $_FILES['your_picture']['name'] : 'None',
                ":fname"        => $first_name,
                ":lname"        => $last_name,
                ":dob"          => $dob,
                ":phone_number" => $removed_brackets,
                ":level"        => $level,
                ":timestamp_"   => date("Y-m-d H:i:s")
            )
        );

        if($added){
            echo "success";
            //send sms to phone number
        }
    }
    else{
        echo "User with the phone number already exitst";
    }
    
?>
