<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location: dashboard.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
      .login-page{
        background: rgb(63,94,251);
        background: linear-gradient(128deg, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%); 
      }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo bg-light font-weight-bold">
    <a href="#"><b>Admin</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card border-info">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <div id="alert"></div>
      <form action="" method="post" id="login_form">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <strong class="text-danger" id="emailErr"></strong>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <strong class="text-danger" id="passErr"></strong>
        <div class="row">
          <div class="col-12">
            <input type="submit" name="submit" id="login" value="Sign In" class="btn btn-primary btn-block">
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script>
    // Handle admin login
    $("#login").click(function(e){
        e.preventDefault();
        $("#login").val('Please wait...');

        $("#emailErr").text('');
        $("#passErr").text('');
        if($("#email").val() == ''){
            $("#emailErr").text('* Email must be required!');
        }else if($("#password").val() == ''){
            $("#passErr").text('* Password must be required!');
        }else{
            $.ajax({
                type: "POST",
                url: "../lib/action.php",
                data: $("#login_form").serialize()+'&action=admin_login',
                success: function (response) {
                    $("#login_form")[0].reset();
                    $("#login").val('Sign In');
                    if(response == 'admin_login'){
                        window.location = 'dashboard.php';
                    }else{
                        $("#alert").html(response);
                    }
                }
            });
        }

    });
</script>
</body>
</html>
