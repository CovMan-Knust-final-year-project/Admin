<?php 

    session_start();
    if(isset($_SESSION["id"])){
    }else{
        header('Location: index.php');
    }

    //positive are denoted by 1
    //negative cases are denoted by 0

    include_once 'database/config.php';
    include_once 'partials/header.php';
    include_once 'helpers/functions.php';

    $org_id       = $_SESSION['id'];
    $query        = "SELECT * FROM attendance WHERE org_id = :org_id ORDER BY id DESC";
    $statement    = $con->prepare($query);
    $statement->execute(
        array(
            ":org_id" => $org_id,
        )
    );

    $count = $statement->rowCount();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;    
?>


<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="javascript:;">CovMan | Attendance</a>
            </div>
            
        <!-- adding the remaining navbar -->
        <?php include_once 'partials/navbar.php';?>
    <!-- End Navbar -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title ">All Attendance</h4>
                            <p class="card-category"> Detailed report of all attendance marked</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if ($count > 0 && !empty($rows)) { ?>
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                S/N
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Venue
                                            </th>
                                            <th>
                                                Time
                                            </th>
                                            <!-- <th class="text-center">
                                                Action
                                            </th> -->
                                        </thead>
                                        <tbody>
                                            <?php foreach($rows as $results){ ?>
                                                <tr>
                                                    <td>
                                                        <?= $i; ?>
                                                    </td>
                                                    <td>
                                                        <?= dateFormat($results['date_marked']) ?>
                                                    </td>
                                                    <td>
                                                        <?= fetchUserDetailsFromID($con, $results['user_id'], 'first_name') .' '. fetchUserDetailsFromID($con, $results['user_id'], 'last_name') ?>
                                                    </td>
                                                    <td>
                                                        <?= fetchMountPointDetailsFromID($con, $results['venue'], 'venue')?>
                                                    </td>
                                                    <td class="text-primary">
                                                        <?= $results['time_marked']; ?>
                                                    </td>
                                                    <!-- <td class="text-center">
                                                        <button type="button" name="update" class="btn-sm btn-dark"><i
                                                                class=" fa fa-envelope"></i></button> -->
                                                        <!-- <button type="button" name="delete" class="btn-sm btn-danger update" data-toggle="modal"
                                                        data-target="#authoritiesModal"><i class="fa fa-ambulance"></i></button> -->
                                                    <!-- </td> -->
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php 
                                    }else{?>
                                        <h3 class='text-center'>No attendance Yet</h3>
                                <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include_once 'partials/footer.php'?>
