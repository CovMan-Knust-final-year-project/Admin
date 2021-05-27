<?php
    
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    if(isset($_POST['topic']) && isset($_POST['message'])){

        $user_id_4_message = $_COOKIE['user_id_4_message'];

        $title   = $_POST['topic'];
        $message = $_POST['message'];

        $query = "INSERT INTO messages(status, org_id, user_id, topic, message, date_added, time_added, timestamp) 
                VALUES(1, :org_id, :user_id, :topic, :message,  curdate(),TIME_FORMAT(CURRENT_TIME(),'%h:%i:%s'), :timestamp_)";

        $statement = $con->prepare($query);
        $has_added = $statement->execute(
            array(
                ":org_id"     => $_SESSION['id'],
                ":user_id"    => $user_id_4_message,
                ":topic"      => $title,
                ":message"    => $message,
                ":timestamp_" => date("Y-m-d H:i:s"),
            )
        );

        if($has_added){
            //possibility that sms would be delivered is far greater than the notification. Thus our main aim is getting the SMS out.
            //TODO: save to notifications
            echo "success";
            sendSms(fetchUserDetailsFromID($con, $user_id_4_message, 'phone_number'), $message);
        }
    }
    
?>