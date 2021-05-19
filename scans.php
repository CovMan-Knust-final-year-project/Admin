<?php include_once 'partials/header.php'?>


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
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                <span class="badge badge-success">Negative</span>
                                            </td>
                                            <td>
                                                Niger Hill
                                            </td>
                                            <td>
                                                30&#176;C
                                            </td>
                                            <td class="text-primary">
                                                <script>
                                                    document.write(new Date());
                                                </script>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" name="update" class="btn-sm btn-dark"><i
                                                        class=" fa fa-envelope"></i></button>
                                                <!-- <button type="button" name="delete" class="btn-sm btn-danger update" data-toggle="modal"
                                                data-target="#authoritiesModal"><i class="fa fa-ambulance"></i></button> -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">Positive</span>
                                            </td>
                                            <td>
                                                Niger Hill
                                            </td>
                                            <td>
                                                50&#176;C
                                            </td>
                                            <td class="text-primary">
                                                <script>
                                                    document.write(new Date());
                                                </script>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" name="update" class="btn-sm btn-dark"><i
                                                        class=" fa fa-envelope"></i></button>
                                                <button type="button" name="delete" class="btn-sm btn-danger update" data-toggle="modal" data-target="#authoritiesModal"><i
                                                        class="fa fa-ambulance"></i></button>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include_once 'partials/footer.php'?>