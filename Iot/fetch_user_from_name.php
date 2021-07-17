<?php
    include_once '../database/config.php';

    if(isset($_POST["name"])){
        $query = "SELECT * FROM users WHERE CONCAT(first_name, ' ', last_name) LIKE :the_name";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":the_name" => "%".$_POST['name']."%"
            )
        );
        if($statement->rowCount() > 0){
            $result = $statement->fetch();
            echo json_encode(
                array(
                    "status" => "success", 
                    "user_id" => $result['id']
                )
            );
        }
        else{
            echo json_encode(
                array(
                    "status" => "failed", 
                    "message" => "No such user"
                )
            );
        }
    }
    else{
        echo "No name";
    }
?>