<?php

    require_once('../config.php');
    require_once('../../helpers/functions.php');

    date_default_timezone_set("Africa/Accra");

    $company_name = $_POST["company_name"];
    $phone_number = $_POST["phone_number"];
    $username     = $_POST["username"];      
    $password     = $_POST["password"];  
    
    $removed_brackets = removeBracketsFromPhone($phone_number);
    $password         = crypt($password, '$6$rounds=1000$ldfowetwnvmlope$');

    //status( 0 means deleted, 1 means active)
    $query = "INSERT INTO admin(status, company_name, phone_number, username, password, date_created, time_created, time_stamp) VALUES (1, :name, :phone_number, :username, :password, curdate(),TIME_FORMAT(CURRENT_TIME(),'%h:%i:%s'), :timestamp_)";
    $statement = $con->prepare($query);

    $count_query = "SELECT * FROM admin WHERE status = 1 AND username = :username AND phone_number = :number_";
    $count_statement = $con->prepare($count_query);
    $count_statement->execute(
        array(
            ":username" => $username,
            ":number_"  => $removed_brackets,
        )
    );
    if($count_statement->rowCount() == 0){
        $added = $statement->execute(
            array(
                ":name"         => $company_name,
                ":phone_number" => $removed_brackets,
                ":username"     => $username,
                ":password"     => $password,
                ":timestamp_"   => date("Y-m-d H:i:s")
            )
        );

        if($added){
            echo "success";
            //send sms to phone number
            sendSms($removed_brackets, "Hello " . $username . ", thank you for registering. Your account has been successfully created bearing the name ". $company_name . ".Lets help in your fight against Covid-19. Contact customer care on 0268977129 if you have any concerns. Thank you.");
        }
    }
    else{
        echo "User with the username already exitst";
    }
    
?>