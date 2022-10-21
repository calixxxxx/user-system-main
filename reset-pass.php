<<?php 
	require_once 'assets/php/auth.php';

	$user = new Auth();

	$msg = '';
	if(isset($_GET['email']) && isset($_GET['token'])){
		$email = $user->test_input($_GET['email']);
		$token = $user->test_input($_GET['token']);

		$auth_user = $user->reset_pass_auth($email, $token);

		if($auth_user != null){
			if(isset($_POST['submit'])){
				$newpass = $_POST['password'];
				$cnewpass = $_POST['cpassword'];

				$hnewpass = password_hash($newpass, PASSWORD_DEFAULT);

				if($newpass == $cnewpass){
					$user->update_new_pass($hnewpass, $email);
					$msg = 'Password has been changed Successfully!<br> <a href="index.php"> Login Here </a>';
				}else{
					$msg = 'Password did not matched';
				}
			}
		}else{
		header('location:index.php');
		exit();

	}
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>RESET PASS</title>
 	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
 </head>
 <body style="background-image: linear-gradient(to right, #868f96 0%, #596164 100%);">
 <div class="row justify-content-center wrapper" id="login-box">
		<div class="col-lg-7 my-auto">
			<div class="card-group myShadow">
				<div class="card rounded-left p-4" style="flex-grow: 1.4;">
					<h1 class="text-center font-weight-bold text-primary"> Reset Password</h1>
					<hr class="my-3">
					<form action="#" method="post" class="px-3" id="login-form">
						<div class="text-center lead my-2"><?= $msg; ?></div>
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="password" class="form-control rounded-0" placeholder="New Password" required minlength="5">
						</div>
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="cpassword" class="form-control rounded-0" placeholder="Confirm New Password" required minlength="5">
						</div>
					
						<div class="form-group">
							<input type="submit" value="Reset" name="submit" class="btn btn-primary btn-lg btn-block myBtn">
						</div>
					</form>
				</div>
				<div class="card justify-content-center rounded-right myColor p-4">
					<h1 class="text-center font-weight-bold text-white">Reset Your Password</h1>
					<hr class="my-3 bg-light myHr"></hr>
					<p class="text-center font-weight-bolder text-light lead">Enter New Password!</p>
					<button class="btn btn-outline-light btn-lg allign-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
 </body>
 </html>