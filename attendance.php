<?php include_once 'partials/header.php'?>


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
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                1st June, 2021
                                            </td>
                                            <td>
                                                Niger Hill
                                            </td>
                                            <td>
                                                College Of Science
                                            </td>
                                            <td class="text-primary">
                                                03:30pm
                                                <!-- <script>
                                                    document.write(new Date());
                                                </script> -->
                                            </td>
                                            <!-- <td class="text-center">
                                                <button type="button" name="update" class="btn-sm btn-dark"><i
                                                        class=" fa fa-envelope"></i></button> -->
                                                <!-- <button type="button" name="delete" class="btn-sm btn-danger update" data-toggle="modal"
                                                data-target="#authoritiesModal"><i class="fa fa-ambulance"></i></button> -->
                                            <!-- </td> -->
                                        </tr>

                                        <tr>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                23rd May, 2021
                                            </td>
                                            <td>
                                                Johnny English
                                            </td>
                                            <td>
                                                School of Business
                                            </td>
                                            <td class="text-primary">
                                                08:50am
                                                <!-- <script>
                                                    document.write(new Date());
                                                </script>
                                            </td> -->
                                            <!-- <td class="text-center">
                                                <button type="button" name="update" class="btn-sm btn-dark"><i
                                                        class=" fa fa-envelope"></i></button>
                                                <button type="button" name="delete" class="btn-sm btn-danger update" onclick="callAmbulance()"><i
                                                        class="fa fa-ambulance"></i></button>
                                            </td> -->
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
    <script>
        function callAmbulance(id){
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
                        url: "database/call_ambulance.php",
                        method: "POST",
                        data: {
                            "id" : id, 
                        },
                        success: function(data) {
                        //    alert(data);
                        if(data=='success'){
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