<?php
    // $response = '';
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    if (isset($_POST["venue_name"])) {

        $sql = "SELECT * FROM mount_point WHERE org_id = :id AND venue = :venue AND status = 1";
        $statement = $con->prepare($sql);
        $statement->execute(
            array(
            ':id'    => trim($_SESSION['id']),
            ':venue' => $_POST['venue_name']
            )
        );
        $count = $statement->rowCount();

        //status 0 means that the item has been deleted; 1 means the item is active.
        if ($count == 0) {
            $add_query      = "INSERT INTO mount_point(status, org_id, venue, timestamp_) VALUES(1, :org_id, :venue, :timestamp_)";
            $add_statement  = $con->prepare($add_query);
            $added = $add_statement->execute(
                array(
                    ":org_id"       => trim($_SESSION['id']),
                    ":venue"        => $_POST['venue_name'],
                    ":timestamp_"   => date('Y-m-d H:i:s')
                )
            );
            if($added){
                echo "success";
            }

        } else {
            echo "Mount point already exists";
        }
    }
?>