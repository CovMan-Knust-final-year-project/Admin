<?php
    function countDailyScan($con){
        $query = "SELECT * FROM scans WHERE date_scanned = :todays_date AND org_id = :id";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":todays_date" => date('Y-m-d'),
                ":id"          => $_SESSION['id'],
            )
        );

        return $statement->rowCount();
    }

    function fetchDailyMaxtemperature($con){
        $query = "SELECT max(temperature) AS max_temp FROM scans WHERE date_scanned = :todays_date AND org_id = :id LIMIT 1";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":todays_date" => date('Y-m-d'),
                ":id"          => $_SESSION['id'],
            )
        );

        return $statement->fetch()['max_temp'];
    }

    function countPositiveCases($con){
        //status 1 means the case is positive, otherwise its 0 negative
        $query = "SELECT * FROM scans WHERE date_scanned = :todays_date AND org_id = :id AND status = 1";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":todays_date" => date('Y-m-d'),
                ":id"          => $_SESSION['id'],
            )
        );

        return $statement->rowCount();
    }

    function countNegativeCases($con){
        //status 1 means the case is positive, otherwise its 0 negative
        $query = "SELECT * FROM scans WHERE date_scanned = :todays_date AND org_id = :id AND status = 0";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":todays_date" => date('Y-m-d'),
                ":id"          => $_SESSION['id'],
            )
        );

        return $statement->rowCount();
    }

    function CountAllScans($con, $from_table){
        $query = "SELECT * FROM $from_table";
        $statement = $con->prepare($query);

        $statement->execute();

        return $statement->rowCount();
    }

    function fetchLatestUpdateDate_users($con, $from_table){
        //fetching the timestamp
        $query = "SELECT MAX(time_stamp) AS max_time FROM $from_table LIMIT 1";
        $statement = $con->prepare($query);

        $statement->execute();

        //using the timestamp to fetch the date
        $date_query = "SELECT date_created FROM $from_table WHERE time_stamp = :time_stamp";
        $date_statement = $con->prepare($date_query);
        $date_statement ->execute(
            array(
                ":time_stamp" => $statement->fetch()['max_time'],
            )
        );

        return $date_statement->fetch()['date_created'];
    }

    function fetchLatestUpdateDate_scans($con, $from_table){
        //fetching the timestamp
        $query = "SELECT MAX(time_stamp) AS max_time FROM $from_table LIMIT 1";
        $statement = $con->prepare($query);

        $statement->execute();

        //using the timestamp to fetch the date
        $date_query = "SELECT date_scanned FROM $from_table WHERE time_stamp = :time_stamp";
        $date_statement = $con->prepare($date_query);
        $date_statement ->execute(
            array(
                ":time_stamp" => $statement->fetch()['max_time'],
            )
        );

        return $date_statement->fetch()['date_scanned'];
    }

    function fetchLatestUpdateDate_cases($con, $from_table){
        //fetching the timestamp
        $query = "SELECT MAX(time_stamp) AS max_time FROM $from_table LIMIT 1";
        $statement = $con->prepare($query);

        $statement->execute();

        //using the timestamp to fetch the date
        $date_query = "SELECT date_reported FROM $from_table WHERE time_stamp = :time_stamp";
        $date_statement = $con->prepare($date_query);
        $date_statement ->execute(
            array(
                ":time_stamp" => $statement->fetch()['max_time'],
            )
        );

        return $date_statement->fetch()['date_reported'];
    }

    

?>