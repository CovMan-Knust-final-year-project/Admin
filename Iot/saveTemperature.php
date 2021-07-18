<?php
    include_once '../database/config.php';
    include_once '../helpers/functions.php';

    //positive cases are denoted by 1
    //negative cases are denoted by 0

    if(isset($_POST['person_id']) && isset($_POST['org_id']) && isset($_POST['venue']) && isset($_POST['temp'])){
        $query = "INSERT INTO scans (org_id, mount_point_id, status, user_id, temperature, date_scanned, time_scanned, time_stamp) 
            VALUES(:org_id, :mount_point_id, :status, :user_id, :temp, curdate(),TIME_FORMAT(CURRENT_TIME(),'%h:%i:%s'), :time_stamp)";

        $statement = $con->prepare($query);
        $marked = $statement->execute(
            array(
                ":org_id"          => $_POST['org_id'],
                ":mount_point_id"  => $_POST['venue'],
                ":status"          => $_POST['temp'] >= 37.00 ? 1 : 0,
                ":user_id"         => $_POST['person_id'],
                ":temp"            => $_POST['temp'],
                ":time_stamp"      => date("Y-m-d H:i:s")
            )
        );

        if($marked){
            // report case if temp is more than 37
            echo json_encode(
                array(
                    "status" => "success", 
                )
            );

            $person_name = fetchUserDetailsFromID($con, $_POST['person_id'], 'first_name') . " " . fetchUserDetailsFromID($con, $_POST['person_id'], 'last_name');
            $mount_point = fetchMountPointDetailsFromID($con, $_POST['venue'], 'venue');
            $the_date    = dateFormat(date("Y-m-d H:i:s"));
            $time        = date('H:i:s');

            $user_message_good = "Hi " . $person_name . ", you have successfully been scanned in " . $mount_point . " today, " . $the_date . " at " . $time . ". Your temperature was " . $_POST['temp']. "°C .We have not found any symptoms of COVID-19, continue to stay safe.";
            $user_message_bad  = "Hi " . $person_name . ", your temperature " . $_POST['temp']. "°C is above normal based on scan taken at " . $mount_point ." on " . $the_date. " at " . $time . " Stay put, admin has been notified to take you for further tests.";
            $admin_message     = "Suspected case encountered. Proceed to take " . $person_name . " for further tests";

            if($_POST['temp'] >= 37){ #suspected case
               #send sms to admin 
               sendSms(fetchOrgDetailsfromID($con, $_POST['org_id'], 'phone_number'), $admin_message);

               #send sms to user to await instructions from admin
               sendSms(fetchUserDetailsFromID($con, $_POST['person_id'], 'phone_number'), $user_message_bad);
            }
            else{
                #send sms to user concerning scan details
                sendSms(fetchUserDetailsFromID($con, $_POST['person_id'], 'phone_number'), $user_message_good);
            }
        }
        else{
            echo json_encode(
                array(
                    "status" => "failed", 
                    "message" => "Something went wrong"
                )
            );
        }
    }
    else{
        echo "Provide details";
    }

?>