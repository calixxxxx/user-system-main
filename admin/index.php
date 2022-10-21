<?php 

	session_start();
	if(isset($_SESSION['username'])){
		header('location:admin-dashboard.php');
		exit();
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | Admin</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<style type="text/css">
		html,body{
			height: 100%;

		}
	</style>
</head>
<body class="bg-dark">
	<div class="container h-100">
		<div class="row h-100 align-items-center justify-content-center">
			<div class="col-lg-5">
				<div class="card border-success shadow-lg">
					<div class="card-header bg-success">
						<h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;Admin Panel Login</h3>
					</div>
					<div class="card-body">
						<form action="" method="post" class="px-3" id="admin-login-form">
							<div id="adminLoginAlert"></div>
							<div class="form-group">
								<input type="text" name="username" class="form-control form-control-lg rounded-0" placeholder="Username" required autofocus="">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control form-control-lg rounded-0" placeholder="Password" required>
							</div>

							<div class="form-group">
								<input type="submit" name="admin-login" class="btn btn-success btn-block btn-lg rounded-0" value="Login" id="adminBtnLogin">
								<a href="../index.php" class="btn btn-dark btn-block btn-lg rounded-0">User Panel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$("#adminBtnLogin").click(function(e){
			if($("#admin-login-form")[0].checkValidity()){
				e.preventDefault();

				$(this).val('Please Wait...');
				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: $("#admin-login-form").serialize()+'&action=adminLogin',
					success:function(response){
						if(response === 'admin_login'){
							window.location = 'admin-dashboard.php';
						}
						else{
							$("#adminLoginAlert").html(response);
						}
						$("#adminBtnLogin").val('Login');
					}

				})
			}
		});
		

	});
</script>


</body>
</html>
