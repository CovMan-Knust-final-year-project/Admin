<?php
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    $mount_point_id = $_COOKIE['edit_id'];

    if(isset($_POST['edit_venue_name'])){
        $query = "UPDATE mount_point SET venue = :venue WHERE id = :id";
        $statement = $con->prepare($query);

        $has_edited = $statement->execute(
            array(
                ":venue" => $_POST['edit_venue_name'],
                ":id"    => $mount_point_id,
            )
        );

        if($has_edited){
            echo "success";
        }
        else{
            echo "Something went wrong";
        }
    }
?>