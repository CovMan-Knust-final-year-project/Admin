<?php
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    if(isset($_POST['company_name']) && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['address'])){
        
        $query = "UPDATE admin SET company_name = :name, email = :email, phone_number = :phone_number, address = :address WHERE id = :id";
        $statement = $con->prepare($query);

        $has_edited = $statement->execute(
            array(
                ":name"         => $_POST['company_name'],
                ":email"        => $_POST['email'],
                ":phone_number" => removeBracketsFromPhone($_POST['phone_number']),
                ":address"      => $_POST['address'],
                ":id"           => $_SESSION['id'],
            )
        );

        if($has_edited){
            $_SESSION['company_name'] = $_POST['company_name'];
            echo "success";
        }
        else{
            echo "Something went wrong";
        }
    }
?>