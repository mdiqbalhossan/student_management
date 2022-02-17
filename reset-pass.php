<?php

require_once 'lib/Auth.php';
$auth = new Auth();

$msg = '';

if(isset($_GET['email']) && isset($_GET['token'])){
    $email = $auth->sanitize_data($_GET['email']);
    $token = $auth->sanitize_data($_GET['token']);

    $auth_student = $auth->resetPassword($email,$token);

    if($auth_student != null){
        if(isset($_POST['submit'])){
            $password = $auth->sanitize_data($_POST['password']);
            $cpassword = $auth->sanitize_data($_POST['cpassword']);

            $hash_password = password_hash($password, PASSWORD_BCRYPT);

            if($password == $cpassword){
                $auth->updatePassword($hash_password,$email);

                $msg = 'Password changed Succesfully!<br><a href="index.php">Login Here</a>';
            }else{
                $msg = 'Password didn\'t matched!. Please try again';
            }
        }
    }else{
        header('location:index.php');
		exit();
    }
}else{
    header('location:index.php');
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div class="container">
		<!-- Forgot From Start -->
		<div class="row justify-content-center wrapper" id="reset_password_box">
			<div class="col-lg-10 my-auto">
				<div class="card-group my_shadow">
					<div class="card rounded-left p-4" style="flex-grow: 1.4;">
						<h1 class="text-center font-weight-bold text-primary">Reset Password</h1>
						<hr class="my-3">
						<div class="text-center text-danger lead my-2"><?= $msg; ?></div>
						<form action="#" method="post" class="p-3" id="login_form">
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>
								</div>
								<input type="password" name="cpassword" id="password" class="form-control rounded-0" placeholder="New Password" required minlength="5">
							</div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>
								</div>
								<input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Confirm Password" required minlength="5">
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="Reset Password" id="login_btn" class="btn btn-primary btn-lg btn-block mybtn">
							</div>
						</form>
					</div>
					<div class="card justify-content-center rounded-right my_color p-4">
						<h1 class="text-center font-weight-bold text-white">Reset your password Here!</h1>
						<hr class="my-3 bg-light my_hr">	
						<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 my_link_btn" id="register_link">Sign In</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Forgot From End -->
	</div>

	<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>