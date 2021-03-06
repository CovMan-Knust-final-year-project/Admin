<?php
    include('sms.php');

    function sendSms($phone_number, $message){
        $send = new SendSms();
        $send->key = 'txTZ1jJdWREgUqJSrdCIVu2IO';
        $send->message = strip_tags(str_replace(array("\r", "\n"), ' ', str_replace(array("&"), ' n ', $message)));
        // $send->message = $message;

        $send->numbers = $phone_number;

        $sender_id    = 'CovMan';
        $send->sender = $sender_id;
        $send->sendMessage();
    }

    function addBracketsToPhone($phone)
    {
        $area = substr($phone, 0, 3);
        $part1 = substr($phone, 3, 3);
        $part2 = substr($phone, 6);
        $phone = '(' . $area . ') ' . $part1 . '-' . $part2;

        return $phone;
    }

    function removeBracketsFromPhone($the_number)
    {
        $remove_first_bracket = str_replace("(", "", $the_number);
        $remove_second_bracket = str_replace(")", "", $remove_first_bracket);
        $remove_space = str_replace(" ", "", $remove_second_bracket);
        $remove_dash = str_replace("-", "", $remove_space);
        $the_number = $remove_dash;

        return $the_number;
    }

    function dateFormat($date){
        return date('l, M j, Y', strtotime($date));
    }

    function fetchUserDetailsFromID($con, $id, $scope){
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":id" => $id,
            )
        );

        $result = $statement->fetch();
        return $result[$scope];
    }

    function fetchMountPointDetailsFromID($con, $id, $scope){
        $query = "SELECT * FROM mount_point WHERE id = :id";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":id" => $id,
            )
        );

        $result = $statement->fetch();
        return $result[$scope];
    }

    function fetchOrgDetailsfromID($con, $id, $scope){
        $query = "SELECT * FROM admin WHERE id = :id";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":id" => $id,
            )
        );

        $result = $statement->fetch();
        return $result[$scope];
    }

    // function fetchScanId($con, $time_stamp){
    //     $query = "SELECT * FROM scans WHERE (SELECT TIMEDIFF(:current_time_stamp, :time_stamp)) <= '00:00:05'";
    //     $statement = $con->prepare($query);

    //     $statement->execute(
    //         array(
    //             ":current_time_stamp"   => date("Y-m-d H:i:s"),
    //             ":time_stamp"           => $time_stamp,
    //         )
    //     );

    //     $result = $statement->fetch();
    //     return $result['id'];
    // }
?>