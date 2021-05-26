<?php
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    date_default_timezone_set("Africa/Accra");

    $first_name     = $_POST["edit_f_name"];
    $last_name      = $_POST["edit_l_name"];
    $dob            = $_POST["edit_dob"];      
    $phone_number   = $_POST["edit_phone_number"];  
    $level          = $_POST["edit_level"];  

    $removed_brackets = removeBracketsFromPhone($phone_number);

    // $targetPath = "";

    // if (is_array($_FILES)) {
    //     if (is_uploaded_file($_FILES['your_picture']['tmp_name'])) {
    //         $sourcePath = $_FILES['your_picture']['tmp_name'];
    //         $targetPath = "../../assets/img/members/" . $_FILES['your_picture']['name'];
    //         if (move_uploaded_file($sourcePath, $targetPath)) {
    //         }
    //     }
    // }

    //status( 0 means deleted, 1 means active)
    $query = "UPDATE users SET first_name = :fname, last_name = :lname, dob = :dob, phone_number = :phone_number, level = :level WHERE id = :id;";
    $statement = $con->prepare($query);

    $added = $statement->execute(
        array(
            ":fname"        => $first_name,
            ":lname"        => $last_name,
            ":dob"          => $dob,
            ":phone_number" => $removed_brackets,
            ":level"        => $level,
            ":id"           => $_COOKIE['edit_id'],
        )
    );

    if($added){
        echo "success";
    }
    else{
        echo "something went wrong";
    }
    
    
?>