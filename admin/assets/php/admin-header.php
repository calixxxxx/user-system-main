<?php 

	session_start();
	if(!isset($_SESSION['username'])){
		header('location:index.php');
		exit();
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<?php 

 	$title = basename($_SERVER['PHP_SELF'],'.php');
	
 	$title = explode('-', $title);
 	$title = ucfirst($title[1]);
	
 	

 	 ?>
 	<title><?= $title; ?> Admin Panel</title>


 	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#open-nav").click(function(){
				$(".admin-nav").toggleClass('animate');
			});
		});

		$('.dropdown-menu').on('click', function(e) {
			e.stopPropagation();
			});
		

	</script>

	<style type="text/css">
		.admin-nav{
			width: 220px;
			min-height: 100vh;
			overflow: hidden;
			background-color: #343a40;
			transition: 0.3s all ease-in-out;
		}
		.admin-link{
			background-color: #343a40; 
		}

		.admin-link:hover, .nav-active{
			background-color: #212529;
			text-decoration: none;
		}
		.animate{
			width: 0;
			transition: 0.5s all ease-in-out;
		
		}
		.footer{
			position: fixed;
			bottom: 0;
			}
	</style>
 </head>
<!-- background-image: linear-gradient( 135deg, #92FFC0 10%, #002661 100%) -->
 <body style="background-color: #cccccc">



 	<div class="container-fluid">
 		<div class="row">
 			<div class="admin-nav p-0">
 				<h4 class="text-light text-center p-2">Admin Panel</h4>

 				<div class="list-group list-group-flush" >

 					<a href="admin-dashboard.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php')?"nav-active":""; ?>"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp;Dashboard</a>
 					<a href="admin-users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php')?"nav-active":""; ?>"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Users</a>
 					<a href="admin-records.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-records.php')?"nav-active":""; ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp;Records</a>
 					<a href="admin-events.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-events.php')?"nav-active":""; ?>"><i class="fas fa-calendar-week"></i>&nbsp;&nbsp;Events</a>
 					<a href="admin-deleted-users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-deleteduser.php')?"nav-active":""; ?>"><i class="fas fa-user-slash"></i>&nbsp;&nbsp;Deleted User</a>
 					<a href="admin-deleted-records.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-deleted-records.php')?"nav-active":""; ?>"><i class="fas fa-folder-open"></i>&nbsp;&nbsp;Archived Records</a>
 					<!-- <a href="assets/php/admin-action.php?export=excel" class="list-group-item text-light admin-link "><i class="fas fa-table"></i>&nbsp;&nbsp;Export Users</a> -->
					<a href="admin-manage.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-manage.php')?"nav-active":""; ?>"><i class="fas fa-tasks"></i>&nbsp;&nbsp;Manage System</a>
 					
 					
 					<li class="nav-item dropdown">
 						<a href="#" class="list-group-item text-light admin-link nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-cog"></i>&nbsp;&nbsp;Settings</a>
 						<div class="dropdown-menu">
				      		
				          	<a href="../index.php" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;User Panel</a>
				      		<a href="assets/php/admin-logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
				      	</div>
 					</li>

 				</div>
 			</div>

 			<div class="col">
 				<div class="row">
 					<div class="col-lg-12 bg-dark pt-2 justify-content-between d-flex">
 						<a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars"></i></h3></a>

 						<!-- <h4 class="text-light" ><?= $title; ?></h4> -->
 						<a href="assets/php/admin-logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
 					</div>
 				</div>
