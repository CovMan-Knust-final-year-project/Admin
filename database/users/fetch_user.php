<?php
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    $user_id   =   $_POST["id"];

    $query = $con->prepare("SELECT * FROM users WHERE id = :id");
                
    $query->execute(
        array(
                ':id'       =>  $user_id,
            )
        );
    $details_check  = $query->fetch();
    $userarray      = array();

    $userarray["image"]        =  $details_check["image"];
    $userarray["first_name"]   =  $details_check["first_name"];
    $userarray["last_name"]    =  $details_check["last_name"];
    $userarray["dob"]          =  $details_check["dob"];
    $userarray["phone_number"] =  addBracketsToPhone($details_check["phone_number"]);
    $userarray["level"]        =  $details_check["level"];

    echo json_encode($userarray);
?>