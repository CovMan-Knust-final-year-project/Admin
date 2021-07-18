<?php

    include_once '../database/config.php';
    include_once '../helpers/functions.php';

    if(isset($_POST['user_id'])){
        $user_id = $_POST["user_id"];

        $query = "SELECT * FROM cases WHERE user_id = :id";
        $statement = $con->prepare($query);
    
        $statement->execute(
            array(
                ":id" => $user_id,
            )
        );
        
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $_array = array();

        foreach ($result as $results){
            //user is present in the system
            array_push($_array,array(
                "id"             => $results['id'],
                "first_name"     => fetchUserDetailsFromID($con, $results['user_id'], 'first_name'),
                "last_name"      => fetchUserDetailsFromID($con, $results['user_id'], 'last_name'),
                "phone_number"   => fetchUserDetailsFromID($con, $results['user_id'], 'phone_number'),
                "org_name"       => fetchOrgDetailsfromID($con, $results['org_id'], 'company_name'),
                "date"           => dateFormat($results['date_reported']),
                "time"           => $results['time_reported'],
            ));
        }

        echo json_encode(array("Server response" => $_array));
        
    }
    else{
        echo "No such user"; //show 404
    }

?>
