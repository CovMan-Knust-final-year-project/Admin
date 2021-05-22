<?php 

  include_once 'partials/header.php';

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
    <?php include_once 'includes/add_mount_point.php';?>
    <?php include_once 'includes/edit_mount_point.php';?>

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
                                        <tr>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                <span class="badge badge-success">Operational</span>
                                            </td>
                                            <td>
                                                College of Science
                                            </td>
                                            <td>
                                                2020-01-01
                                            </td>
                                            <td class="text-center">
                                                <button type="button" name="update" class="btn-sm btn-dark update" data-toggle="modal" data-target="#editMountPointModal"><i
                            class=" fa fa-pencil"></i></button>
                                                <button type="button" name="delete" class="btn-sm btn-danger update" onclick="deleteUser()"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">Damaged</span>
                                            </td>
                                            <td>
                                                School of Business
                                            </td>
                                            <td>
                                                2020-01-01
                                            </td>
                                            <td class="text-center">
                                                <button type="button" name="update" class="btn-sm btn-dark delete"><i
                            class=" fa fa-pencil"></i></button>
                                                <button type="button" name="delete" class="btn-sm btn-danger update" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
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
    <script>
     //Numbers only for arithmetics
    function numberOnly(e) {
        var arr = "1234567890";
        var code;
        if (window.event)
            code = e.keyCode;
        else
            code = e.which;
        var char = keychar = String.fromCharCode(code);
        if (arr.indexOf(char) == -1)
            return false;
    }

    //format phone number
    $("input[name='phone_number']").keyup(function() {
        $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d)+$/, "($1) $2-$3"));
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.your_picture_image')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

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