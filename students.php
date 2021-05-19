<?php 

  include_once 'partials/header.php';

?>
<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="javascript:;">CovMan | Students</a>
            </div>
             <!-- adding the remaining navbar -->
        <?php include_once 'partials/navbar.php';?>
    
    <!-- adding the popup modal -->
    <?php include_once 'includes/add_user.php';?>

    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title ">All Students</h4>
                                    <p class="card-category"> All students registered into the system</p>
                                </div>
                                <div class="col">
                                    <div class="col text-right">
                                        <button type="button" class="btn btn-white text-primary" data-toggle="modal" data-target="#accountModal">
                                            <i class="fa fa-plus"></i> Add Student
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
                                            Image
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Dob
                                        </th>
                                        <th>
                                            Phone number
                                        </th>
                                        <th>
                                            Level
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
                                                <img class="rounded-circle z-depth-2" alt="100x100" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" data-holder-rendered="true" width="15%">
                                            </td>
                                            <td>
                                                Minerva Hooper
                                            </td>
                                            <td>
                                                2020-01-01
                                            </td>
                                            <td class="text-primary">
                                                (026) 897-7129
                                            </td>
                                            <td class="text-primary">
                                                200
                                            </td>
                                            <td class="text-center">
                                                <button type="button" name="update" class="btn-sm btn-dark delete"><i
                            class=" fa fa-pencil"></i></button>
                                                <button type="button" name="delete" class="btn-sm btn-danger update" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                <img class="rounded-circle z-depth-2" alt="100x100" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" data-holder-rendered="true" width="15%">
                                            </td>
                                            <td>
                                                Hipman Heart
                                            </td>
                                            <td>
                                                2020-01-01
                                            </td>
                                            <td class="text-primary">
                                                (026) 897-7129
                                            </td>
                                            <td class="text-primary">
                                                400
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
    </script>