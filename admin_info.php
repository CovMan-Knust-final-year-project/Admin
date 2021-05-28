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
     $query        = "SELECT * FROM admin WHERE id = :org_id";
     $statement    = $con->prepare($query);
     $statement->execute(
         array(
             ":org_id" => $org_id,
         )
     );

     $results = $statement->fetch();
?>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:;">CovMan | Admin Info</a>
                    </div>

                    <!-- adding the remaining navbar -->
                    <?php include_once 'partials/navbar.php'?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Admin Information</h4>
                                    <!-- <p class="card-category">Complete your profile</p> -->
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" id="admin_form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Company</label>
                                                    <input type="text" class="form-control" name="company_name" id="company_name" value="<?= $_SESSION['company_name']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Username</label>
                                                    <input type="text" class="form-control" value="<?= $_SESSION['username']?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Email</label>
                                                    <input type="text" class="form-control" name="email" id="email" value="<?= empty($results['email']) ? 'None' : $results['email'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Phone number</label>
                                                    <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?= addBracketsToPhone($results['phone_number']);?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" value="<?= empty($results['address']) ? 'None' : $results['address'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About Me</label>
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                                                        <textarea class="form-control" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-profile">
                                <div class="card-avatar">
                                    <a href="javascript:;">
                                        <img class="img" src="assets/img/logo.png"/>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-category text-gray">CovMan</h6>
                                    <h4 class="card-title">JESSE ANIM & OWUSU KONADU YIADOM JULIEEN</h4>
                                    <p class="card-description">
                                    The aim of CovMan is to completely replace and automatize all checks that have to be done due to COVID-19                                    </p>
                                    <a href="javascript:;" class="btn btn-primary btn-round">Contact CovMan</a>
                                    <a href="javascript:;" class="btn btn-dark btn-round">Download User App</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <?php require_once 'partials/footer.php'?>
           <script>
            //update admin information
                $(document).on('submit', '#admin_form', function(event) {
                    event.preventDefault();       
                        $.ajax({
                            url: "database/admin/edit_admin_details.php",
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
                                        title: 'Details updated successfully',
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
           </script>