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
    $query        = "SELECT * FROM scans WHERE org_id = :org_id ORDER BY id DESC";
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
                <a class="navbar-brand" href="javascript:;">CovMan | Scans</a>
            </div>
            
        <!-- adding the remaining navbar -->
        <?php include_once 'partials/navbar.php';?>
    <!-- End Navbar -->

        <!-- adding the sendMessage modal -->
        <?php include_once 'includes/scans/scan_message.php'?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">All Scans</h4>
                            <p class="card-category"> Details report of all scans</p>
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
                                                Status
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Temperature
                                            </th>
                                            <th>
                                                Time
                                            </th>
                                            <th class="text-center">
                                                Action
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($rows as $results){ ?>
                                                <tr>
                                                    <td>
                                                        <?= $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($results['status'] == 0){ //person is negative?>
                                                                <span class="badge badge-success">Negative</span>
                                                            <?php
                                                            }
                                                            else{?>
                                                                <span class="badge badge-danger">Suspected Positive</span>
                                                                <!--person is positive 1-->
                                                            <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <!--firstname --> <?= fetchUserDetailsFromID($con, $results['user_id'],'first_name'); ?> <!-- lastname--> <?= fetchUserDetailsFromID($con, $results['user_id'],'last_name'); ?>
                                                    </td>
                                                    <td>
                                                        <?= $results['temperature']?>&#176;C
                                                    </td>
                                                    <td class="text-primary">
                                                        <?=dateFormat($results['date_scanned']);?> at <?=$results['time_scanned'];?>
                                                    </td>
                                                    <td class="text-center">
                                    
                                                        <button type="button" name="update" class="btn-sm btn-dark" data-toggle="modal" data-target="#sendMessageModal" onclick="saveUserId(<?= $results['user_id']?>)"><i class=" fa fa-envelope"></i></button>
                                                        <?php
                                                            if($results['status'] == 1){?>
                                                                <button type="button" name="delete" class="btn-sm btn-danger update" data-toggle="modal" onclick="callAmbulance(<?= $results['user_id']?>,<?= $results['id']?>,<?= $results['mount_point_id']?>)"
                                                                    data-target="#authoritiesModal"><i class="fa fa-ambulance"></i></button>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;}
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                    }else{?>
                                        <h3 class="text-center">No Scans Yet</h3>
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
    <script src="assets/js/js_helpers.js"></script>

    <script>

        //save the user_id for future user
        function saveUserId(id){
            // alert(id);
            setCookie('user_id_4_message', id, 1);
        }                          

        //send message ajax
        $(document).on('submit', '#send_message_form', function(event) {
            event.preventDefault();       
                $.ajax({
                    url: "database/scans/send_message.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        // alert(data);
                        if(data.includes("success")){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Message sent',
                                showConfirmButton: false,
                                timer: 2500
                            }).then((result) => {
                                $('#send_message_form')[0].reset();
                                location.reload();
                            });
                        }
                        else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: data,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                })
        });

        function callAmbulance(user_id, scan_id, mount_point){
        Swal.fire({
                title: 'Call Ambulance?',
                text: 'Are you sure you want to transfer this student to the hospital?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "database/scans/notify_hospital.php",
                        method: "POST",
                        data: {
                            "user_id"     : user_id, 
                            "scan_id"     : scan_id,
                            "mount_point" : mount_point,
                        },
                        success: function(data) {
                        //    alert(data);
                        if(data.includes('success')){
                            Swal.fire(
                                'Ambulance called!',
                                'Hospital has been notified.',
                                'success'
                            ).then((result) =>{
                                location.reload();
                            })
                          }
                        }
                    });
                }
            })
    }
    </script>