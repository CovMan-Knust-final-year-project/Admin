<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>CovMan | Login</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>

    <link rel="stylesheet" href="login_assets/css/style.css"> 

    <link rel="stylesheet" href="sweetalert2.min.css">

</head>

<body>

  
<!-- Form-->
<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header">
    <img src="assets/img/favicon.png" width="50%" style=" display: block;margin-left: auto;margin-right: auto;width: 50%;">
      <h4 style="text-align: center;">A comprehensive Covid 19 management system.</h4>
    </div>
    <div class="form-content">
      <form method="POST" enctype="multipart/form-data" id="login_form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="login_username" name="login_username" required="required"/>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="login_password" name="login_password" required="required"/>
        </div>
        <div class="form-group">
          <label class="form-remember">
            <input type="checkbox"/>Remember Me
          </label><a class="form-recovery" href="#">Forgot Password?</a>
        </div>
        <div class="form-group">
          <button type="submit">Log In</button>
        </div>
      </form>
    </div>
  </div>
  <div class="form-panel two">
    <div class="form-header">
      <h1>Register Account</h1>
    </div>
    <div class="form-content">
      <form method="POST" enctype="multipart/form-data" id="register_form">
        <div class="form-group">
          <label for="username">Company name</label>
          <input type="text" id="company_name" name="company_name" required="required"/>
        </div>
        <div class="form-group">
          <label for="username">Phone number</label>
          <input type="text" id="phone_number" minlength="14" name="phone_number" onkeypress="return numberOnly(event)" maxlength="14" required="required"/>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required="required"/>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required="required"/>
        </div>
        <div class="form-group">
          <label for="cpassword">Confirm Password</label>
          <input type="password" id="cpassword" name="cpassword" required="required"/>
        </div> 
        <div class="form-group">
          <button type="submit" onclick="register_()">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="pen-footer"><a>CovMan 2021</a></div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://codepen.io/andytran/pen/vLmRVp.js'></script>
    <!-- swall alert starts here -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

    <script src="sweetalert2.min.js"></script>
    <!-- swal ends here -->

    <script  src="login_assets/js/index.js"></script>
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

      //login 
      $(document).on('submit', '#login_form', function(event) {
          event.preventDefault();          
            $.ajax({
                url: "database/register_login/login.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if(data.includes(0)){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Incorrect username or password',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                    else if(data.includes(1)){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Login successful',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.href='dashboard.php';
                        });
                    }
                    else if(data.includes(2)){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Account has been blocked. Contact Administrator for help',
                            showConfirmButton: false,
                            timer: 1500
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
        

      //register
      function register_(){
        event.preventDefault();
        var company_name  = $('#company_name').val();
        var phone_number  = $('#phone_number').val();
        var username      = $('#username').val();
        var password      = $('#password').val();
        var cpassword     = $('#cpassword').val();
        
        if(company_name == ""){
           $("#company_name").focus();
        }
        else if(phone_number == ""){
          $("#phone_number").focus();
        }
        else if(username == ""){
          $("#username").focus();
        }
        else if(password != cpassword){
          alert(password + "," + cpassword)
          $("#password").focus();
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Password mismatch',
            showConfirmButton: false,
            timer: 1500,
          })
        }
        else if(password.length < 8){
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Password length must be greater than 8',
            showConfirmButton: false,
            timer: 1500,
          })
        }
        else{
            $.ajax({
                url: "database/register_login/register.php",
                type: "POST",
                data: {
                  "company_name" : company_name,
                  "phone_number" : phone_number,
                  "username"     : username,
                  "password"     : password
                },
                success: function(data) {
                  // alert(data);
                  if(data.includes("success")){
                    $('#register_form')[0].reset();
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Registration complete. Login to proceed',
                      showConfirmButton: false,
                      timer: 2500,
                    }).then((result) =>{
                          location.reload();
                        });
                  }else{
                    Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: data,
                      showConfirmButton: false,
                      timer: 2500,
                    });
                  }
                }
            })
          }
      }
    </script>
</body>

</html>

