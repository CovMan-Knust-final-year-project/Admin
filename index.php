<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login Form - Modal</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>

      <link rel="stylesheet" href="login_assets/css/style.css">

  
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
      <form>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required="required"/>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required="required"/>
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
      <form>
        <div class="form-group">
          <label for="username">Company name</label>
          <input type="text" id="company_name" name="company_name" required="required"/>
        </div>
        <div class="form-group">
          <label for="username">Phone number</label>
          <input type="text" id="phone_number" name="phone_number" onkeypress="return numberOnly(event)" maxlength="14" required="required"/>
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
          <button type="submit">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="pen-footer"><a>CovMan 2021</a></div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://codepen.io/andytran/pen/vLmRVp.js'></script>
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
    </script>
</body>

</html>

