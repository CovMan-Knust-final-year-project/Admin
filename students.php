<?php 

    session_start();
    if(isset($_SESSION["id"])){
    }else{
        header('Location: index.php');
    }

    include_once 'database/config.php';
    include_once 'partials/header.php';
    include_once 'helpers/functions.php';  

    $org_id       = $_SESSION['id'];
    $query        = "SELECT * FROM users WHERE status = 1 AND org_id = :org_id";
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
                <a class="navbar-brand" href="javascript:;">CovMan | Students</a>
            </div>
             <!-- adding the remaining navbar -->
        <?php include_once 'partials/navbar.php';?>
    
    <!-- adding the popup modal -->
    <?php include_once 'includes/users/add_user.php';?>
    <?php include_once 'includes/users/edit_user.php';?>

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
                                <?php if ($count > 0 && !empty($rows)) { ?>
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

                                            <?php
                                               foreach($rows as $results){?>
                                                  <tr>
                                                    <td>
                                                        <?= $i; ?>
                                                    </td>
                                                    <td>
                                                        <img class="rounded-circle z-depth-2" alt="100x100" src="assets/img/members/<?= $results['image']?>" data-holder-rendered="true" width="50" height="50">
                                                    </td>
                                                    <td>
                                                        <?= $results['first_name'] . ' ' . $results['last_name']?>
                                                    </td>
                                                    <td>
                                                        <?= dateFormat($results['dob']); ?>
                                                    </td>
                                                    <td class="text-primary">
                                                        <?= addBracketsToPhone($results['phone_number'])?>
                                                    </td>
                                                    <td class="text-primary">
                                                        200
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" name="update" class="btn-sm btn-dark update" data-toggle="modal" onclick="edit_user(<?= $results['id'];?>)" data-target="#editaccountModal"><i
                                    class=" fa fa-pencil"></i></button>
                                                        <button type="button" name="delete" class="btn-sm btn-danger update" onclick="deleteUser(<?= $results['id'];?>)"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                    }else{?>
                                        <h3 class="text-center">No Users Yet</h3>
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

    $(document).on('submit', '#personal_info', function(event) {
        event.preventDefault();       
            $.ajax({
                url: "database/users/add_user.php",
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
                            title: 'User added successfully',
                            showConfirmButton: false,
                            timer: 2500
                        }).then((result) => {
                            $('#personal_info')[0].reset();
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

    function edit_user(id){
        fetch_user(id);
        setCookie('edit_id', id, 1);
    }

    function fetch_user(id){
        $.ajax({
            url: "database/users/fetch_user.php",
            method: "POST",
            dataType: "json",
            data:{
                "id" : id,
            }, 
            success: function(data) {
                // alert(data);
                $("#your_picture").attr("src","assets/img/members/"+data.image);
                $('#edit_f_name').val(data.first_name);
                $('#edit_l_name').val(data.last_name);
                $('#edit_dob').val(data.dob);
                $('#edit_phone_number').val(data.phone_number);
                $('#edit_level').val(data.level);
            }
        })
    }

    //edit mount point 
    $(document).on('submit', '#edit_personal_info', function(event) {
        event.preventDefault();       
            $.ajax({
                url: "database/users/edit_user.php",
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
                            title: 'User editted',
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

    function deleteUser(id){
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
                        url: "database/users/delete_user.php",
                        method: "POST",
                        data: {
                            "id" : id, 
                        },
                        success: function(data) {
                        //    alert(data);
                        if(data.includes('success')){
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