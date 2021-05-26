<?php
    require_once('../config.php');

    if(isset($_POST['id'])){
        $query = "UPDATE users SET status = 0 WHERE id = :id";
        $statement = $con->prepare($query);
    
        $has_editted = $statement->execute(
            array(
                ":id" => $_POST['id']
            )
        );
    
        if($has_editted){
            echo "success";
        }
        else{
            echo "Something went wrong";
        }
    }
    
?>