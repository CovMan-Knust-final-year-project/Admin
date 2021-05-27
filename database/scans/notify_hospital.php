<?php
    
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    if(isset($_POST['user_id']) && isset($_POST['scan_id'])){

        $user_id     = $_POST['user_id'];
        $scan_id     = $_POST['scan_id'];
        $mount_point = $_POST['mount_point'];

        // status 0 means the issue is still unattended to 
        // status 1 means the issue has been attended to

        $query = "INSERT INTO cases(status, org_id, user_id, scan_id, date_reported, time_reported, time_stamp) 
                VALUES(1, :org_id, :user_id, :scan_id, curdate(),TIME_FORMAT(CURRENT_TIME(),'%h:%i:%s'), :timestamp_)";

        $statement = $con->prepare($query);
        $has_added = $statement->execute(
            array(
                ":org_id"     => $_SESSION['id'],
                ":user_id"    => $user_id,
                ":scan_id"    => $scan_id,
                ":timestamp_" => date("Y-m-d H:i:s"),
            )
        );

        if($has_added){
            //possibility that sms would be delivered is far greater than the notification. Thus our main aim is getting the SMS out.
            //TODO: save to notifications
            echo "success";
            //notify all doctors
            $fetch_query = "SELECT * FROM doctors";
            $fetch_statement = $con->prepare($fetch_query);

            $fetch_statement->execute();
            $result = $fetch_statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $results){
                sendSms($results['phone_number'], 'Ambulance needed to pickup ' . fetchUserDetailsFromID($con, $user_id, 'first_name') . ' ' . fetchUserDetailsFromID($con, $user_id, 'last_name') . " for isolation and Covid-19 test from " . fetchMountPointDetailsFromID($con, $mount_point, 'venue'));
            }
        }
    }
    
?>