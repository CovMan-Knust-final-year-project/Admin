<?php
    require_once('../config.php');

    if(isset($_POST['id'])){
        $query = "SELECT * FROM mount_point WHERE id = :id";
        $statement = $con->prepare($query);

        $has_edited = $statement->execute(
            array(
                ":id"    => $_POST["id"],
            )
        );

        if($has_edited){
            $name = $statement->fetch();
            echo $name['venue']; 
        }
    }

?>