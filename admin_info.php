<?php include_once 'partials/header.php'?>

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
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Company</label>
                                                    <input type="text" class="form-control" value="Kwame Nkrumah University Of Science And Technology" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Username</label>
                                                    <input type="text" class="form-control" value="admin">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Email</label>
                                                    <input type="text" class="form-control" value="info@knust.com.gh">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Address</label>
                                                    <input type="text" class="form-control" value="Kumasi, Ghana">
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