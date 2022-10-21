<?php 
	session_start();
	if(isset($_SESSION['user'])){
		header('location:home.php');
	}

	include_once 'assets/php/config.php';
	$db = new Database();
	$sql = "UPDATE visitors SET hits = hits+1 WHERE id = 0";
	$stmt = $db->conn->prepare($sql);
	$stmt->execute();
	

 ?>
<!DOCTYPE html>
<html lang= "en">
<head>
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<style>
body{
	background-image: url(assets/img/CVSU2.png);
	background-repeat: no-repeat;
  	background-attachment: fixed;
  	background-size: 50%;
  	background-position: top;
  	background-color: #cccccc;
	  

}
</style>
<body >
<div class="container">
	<!-- Login Form Start -->

	<div class="row justify-content-center wrapper" id="login-box">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card rounded-left p-4 bg-dark" style="flex-grow: 1.4;">

					<h1 class="text-center font-weight-bold text-light"> Sign in your account</h1>
					<hr class="my-3">
					<form action="#" method="post" class="px-3" id="login-form">
						<div id="loginAlert"></div>
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-envelope fa-lg"></i>
								</span>
							</div>
							<input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail" required value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email'];} ?>">
						</div>

						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="password" id="password" class="form-control rounded-0" placeholder="password" required value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox float-left">
								<!-- <input type="checkbox" name="remember" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['email']))  { ?> checked <?php } ?> >
								<label for="customCheck" class="custom-control-label text-light">Remember Me</label> -->
							</div>
							<!-- <div class="forgot float-right "> -->
								<!-- <a href="#" id="forgot-link">Forgot Password</a></div> -->
						</div>
						<div class="clearfix"></div>
						<br>
						<div class="form-group">
						<!-- <input type="submit" value="Sign In" id="login-btn" class="btn btn-primary btn-lg btn-block"> -->
						<button class="btn btn-outline-light btn-lg allign-self-center font-weight-bolder myLinkBtn btn" id="login-btn"><i class="fa fa-user-check" aria-hidden="true"></i> Sign In </button>
						</div>

					</form>
				</div>
				<div class="card justify-content-center rounded-right p-4" style="background-color: #006400">

					<h1 class="text-center font-weight-bold text-white">Welcome to CEIT Guidance Record System</h1>
					<hr class="my-3 bg-light myHr"></hr>
					<p class="text-center font-weight-bolder text-light lead"></p>
					<button class="btn btn-outline-light btn-lg allign-self-center font-weight-bolder mt-4 myLinkBtn btn-" id="register-link">Sign Up <i class="fa fa-user-plus" aria-hidden="true"></i></button>
					<a href="admin/index.php" class="btn btn-outline-light btn-lg allign-self-center font-weight-bolder mt-4 myLinkBtn btn-"></i>&nbsp;Admin Login</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Login Form End -->

	<!-- Register Form Start -->

	<div class="row justify-content-center wrapper mt-5" id="register-box" style="display: none;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card justify-content-center rounded-right myColor p-5">
					<h1 class="text-center font-weight-bold text-white">Register</h1>
					<hr class="my-3 bg-light myHr"></hr>
					<p class="text-center font-weight-bolder text-light lead">• Use your CVSU email<br/>• Use your school ID Number<br/>• Password must be 8 character long<br/> • Password must contain 1 Upper Case and 1 Number</p>
					<button class="btn btn-outline-light btn-lg allign-self-center font-weight-bolder mt-4 myLinkBtn" id="login-link">Sign In</button>
				</div>
				<div class="card rounded-left p-4" style="flex-grow: 1.4;">
					<h1 class="text-center font-weight-bold text-dark">Create Account</h1>
					<hr class="my-3">
					<form action="#" method="post" class="px-3" id="register-form">
						<div id="regAlert"></div>
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-user fa-lg"></i>
								</span>
							</div>
							<input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required></input>
						</div>

						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-envelope fa-lg"></i>
								</span>
							</div>
							<input type="email" name="email" id="remail" pattern=".+@cvsu.edu.ph" size="30" class="form-control rounded-0" placeholder="test@cvsu.edu.ph" required></input>
						</div>

						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-address-card fa-lg"></i>
								</span>
							</div>
							<input type="number" name="student_num" id="student_num" pattern="[0-9]+" size="9" class="form-control rounded-0" placeholder="202212345" required></input>
						</div>

						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="password" id="rpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" class="form-control rounded-0" placeholder="Password" required minlength="8"></input>
						</div>

						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-key fa-lg"></i>
								</span>
							</div>
							<input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" required minlength="8"></input>
						</div>
						<div class="form-group">
							<div id="passError" class="text-danger font-weight-bold"></div>
						</div>
					
						<div class="form-group">
							<input type="submit" value="Sign Up" id="register-btn" class="btn btn-dark btn-lg btn-block myBtn">
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>

	<!-- Register Form End -->

	<!-- Forgot Password Form Start -->

	<div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
		<div class="col-lg-10 my-auto">
			<div class="card-group myShadow">
				<div class="card justify-content-center rounded-right myColor p-4">
					<h1 class="text-center font-weight-bold text-white">Reset Password</h1>
					<hr class="my-3 bg-light myHr"></hr>
					<button class="btn btn-outline-light btn-lg allign-self-center font-weight-bolder mt-4 myLinkBtn" id="back-link">Back</button>
				</div>
				<div class="card rounded-left p-4" style="flex-grow: 1.4;">
					<h1 class="text-center font-weight-bold text-primary">Forgot Your Password?</h1>
					<hr class="my-3">
					<p class="lead text-center text-secondary"> To reset your password, enter the registered e-mail address and we will send you the reset instruction on your e-mail!</p>
					<form action="#" method="post" class="px-3" id="forgot-form">
						<div id="forgot-Alert"></div>
						<div class="input-group input-group-lg form-group">
							<div class="input-group-prepend">
								<span class="input-group-text rounded-0">
									<i class="fas fa-envelope fa-lg"></i>
								</span>
							</div>
							<input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-mail" required></input>
						</div>
						
						<div class="form-group">
							<input type="submit" value="Reset password" id="forgot-btn" class="btn btn-primary btn-lg btn-block myBtn">
						</div>
					</form>
				</div>
				
				</div>
			</div>
		</div>
	</div>

	<!-- Forgot Password Form End -->

</div>






<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#register-link").click(function(){
			$("#login-box").hide();
			$("#register-box").show();
		});

		$("#login-link").click(function(){
			$("#login-box").show();
			$("#register-box").hide();
		});

		$("#forgot-link").click(function(){
			$("#login-box").hide();
			$("#forgot-box").show();
		});

		$("#back-link").click(function(){
			$("#forgot-box").hide();
			$("#login-box").show();
		});

		//Register Ajax
		$("#register-btn").click(function(e){
			if($("#register-form")[0].checkValidity()){
				e.preventDefault();

				if($("#rpassword").val() != $("#cpassword").val()){
					$("#passError").text('* Password did not matched!');
					$("#register-btn").val('Sign Up');
				}else{
					$("#passError").text('');
					$.ajax({
						url: 'assets/php/action.php',
						method: 'post',
						data: $("#register-form").serialize()+'&action=register',
						success: function(response){
							$("#register-btn").val('Sign Up');
							if(response === 'register'){
								window.location = 'index.php';
							}
							else{
								$("#regAlert").html(response);
							}
						}
					});
				}

			}
		});
		// Login Ajax
		$("#login-btn").click(function(e){
			if($("#login-form")[0].checkValidity()){
				e.preventDefault();

				$("#login-btn").val('Please Wait...');
				$.ajax({
					url: 'assets/php/action.php',
					method: 'post',
					data: $("#login-form").serialize()+'&action=login',
					success:function(response){
						
						$("#login-btn").val('Sign In');
						if(response === 'login') {
							window.location = 'home.php';
						}else{
							$("#loginAlert").html(response);
						}
					}
				});
			}
		});

		// Forgot Password Ajax
		$("#forgot-btn").click(function(e){
			if($('#forgot-form')[0].checkValidity()){
				e.preventDefault();

				$("#forgot-btn").val('Please Wait...');
				$.ajax({
					url: 'assets/php/action.php',
					method: 'post',
					data: $('#forgot-form').serialize()+'&action=forgot',
					success:function(response){
						$("#forgot-btn").val('Reset password');
						$("#forgot-form")[0].reset();
						$("#forgot-Alert").html(response);

					}
				})
			}
		})

	});
</script>
</body>
</html>