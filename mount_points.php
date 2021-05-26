<?php 
  session_start();
  if(isset($_SESSION["id"])){
  }else{
      header('Location: index.php');
  }

  //operational mount points are denoted by 1
  //non operational ones are denoted by 0

  include_once 'database/config.php';
  include_once 'partials/header.php';

  $org_id       = $_SESSION['id'];
  $query        = "SELECT * FROM mount_point WHERE status = 1 AND org_id = :org_id";
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
                <a class="navbar-brand" href="javascript:;">CovMan | Mount Points</a>
            </div>
             <!-- adding the remaining navbar -->
        <?php include_once 'partials/navbar.php';?>
    
    <!-- adding the popup modal -->
    <?php include_once 'includes/mount_points/add_mount_point.php';?>
    <?php include_once 'includes/mount_points/edit_mount_point.php';?>

    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary" style="background: black;">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title ">All Mount Points</h4>
                                    <p class="card-category"> Places in your organization where the CovMan Hardware is installed</p>
                                </div>
                                <div class="col">
                                    <div class="col text-right">
                                        <button type="button" class="btn btn-white text-primary" data-toggle="modal" data-target="#addMountPointModal">
                                            <i class="fa fa-plus"></i> Add Mount Point
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                                                Name of Venue
                                            </th>
                                            <th>
                                                Date mounted
                                            </th>
                                            <th class='text-center'>
                                                Actions
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($rows as $results){?>
                                                    <tr>
                                                        <td>
                                                            <?= $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($results['operational_status'] == 0){ ?> <!--means that the hardware is not functional-->
                                                                    <span class="badge badge-danger">Damaged</span>
                                                                <?php 

                                                                }else{?>
                                                                    <!-- hardware is functional -->
                                                                    <span class="badge badge-success">Operational</span>
                                                                <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?= $results['venue']?>
                                                        </td>
                                                        <td>
                                                            <?= $results['timestamp_']?>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" name="update" class="btn-sm btn-dark update" data-toggle="modal" onclick="fetch_data(<?= $results['id'] ?>)" data-target="#editMountPointModal"><i
                                        class=" fa fa-pencil"></i></button>
                                                            <button type="button" name="delete" class="btn-sm btn-danger update" onclick="deleteUser()"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                            <?php
                                                $i++;}
                                            ?>
                                        </tbody>
                                    </table>
                               <?php }else{ ?>
                                   <!-- no items in the database -->
                                   <h3 class="text-center"> No mount point yet</h3>
                               <?php } ?>
                                
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

    //add mount point 
    $(document).on('submit', '#add_mount_point_form', function(event) {
          event.preventDefault();       
            $.ajax({
                url: "database/mount_points/add_mount_point.php",
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
                            title: 'Mount point added',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            $('#add_mount_point_form')[0].reset();
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

        function fetch_data(id){
            fetch_name(id);
            setCookie('edit_id', id, 1);
        }

        function fetch_name(id){
            $.ajax({
                url: "database/mount_points/fetch_mount_name.php",
                method: "POST",
                data:{
                    "id" : id,
                }, 
                success: function(data) {
                    $('#edit_venue_name').val(data);
                }
            })
        }

        //edit mount point 
        $(document).on('submit', '#edit_mount_point_form', function(event) {
            event.preventDefault();       
                $.ajax({
                    url: "database/mount_points/edit_mount_point.php",
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
                                title: 'Mount point editted',
                                showConfirmButton: false,
                                timer: 2500
                            }).then((result) => {
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


    function deleteUser(){
        Swal.fire({
                title: 'Delete?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "database/deleteuser.php",
                        method: "POST",
                        data: {
                            // "id" : id, 
                        },
                        success: function(data) {
                        //    alert(data);
                        if(data=='success'){
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
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