<?php 
require_once 'assets/php/header.php';
 ?>
 	<?php if($verified == 'Verified!'): ?>
 	<div class="container">
 		<div class ="row justify-content-center">
 			<div class="col-lg-10">
 				<div class="card rounded-0 mt-3 border-success">
 					<div class="card-header border-success">
 						<ul class="nav nav-tabs card-header-tabs">
 							<li class="nav-item">
 								<a href="#profile" class="nav-link active text-success font-weight-bold" data-toggle="tab">Profile</a>
 							</li>
 							<li class="nav-item">
 								<a href="#editProfile" class="nav-link text-success font-weight-bold" data-toggle="tab">Edit Profile</a>
 							</li>
 							<li class="nav-item">
 								<a href="#changePass" class="nav-link text-success font-weight-bold" data-toggle="tab">Change Password</a>
 							</li>
 						</ul>
 					</div>
 					<div class="card-body">
 						<div class="tab-content">
	
 							<!-- Profile Tab  Start-->
 							<div class="tab-pane container active" id="profile">
 								<div id="verifyEmailAlert"></div>
 								<div class="card-deck">
 									<div class="card border-success">
 										<div class="card-header bg-success text-light font-weight-bold text-center lead">
 											User ID: <?= $cid; ?>
 										</div>
 										<div class="card-body">
 											<p class="card-text p-2 m-1 rounded border-success" style="border:1px solid #0275d8;"><b>Name: </b><?= $cname; ?></p>
 											<p class="card-text p-2 m-1 rounded border-success" style="border:1px solid #0275d8;"><b>E-Mail </b><?= $cemail; ?></p>
 											<p class="card-text p-2 m-1 rounded border-success" style="border:1px solid #0275d8;"><b>Gender: </b><?= $cgender; ?></p>
 											<p class="card-text p-2 m-1 rounded border-success" style="border:1px solid #0275d8;"><b>Date of Birth: </b><?= $cdob; ?></p>
 											<p class="card-text p-2 m-1 rounded border-success" style="border:1px solid #0275d8;"><b>Phone: </b><?= $cphone; ?></p>
 											<p class="card-text p-2 m-1 rounded border-success" style="border:1px solid #0275d8;"><b>Registered On: </b><?= $reg_on; ?></p>
 											<p class="card-text p-2 m-1 rounded border-success" style="border:1px solid #0275d8;"><b>Account Status: </b><?= $verified; ?>
 											<?php if($verified == 'Not Verified!'): ?>	
 												<a href="#" id="verify-email" class="float-right"> Verify Now </a> 
 											<?php endif; ?>
 											</p>
 											<div class="clearfix"></div>
 										</div>
 									</div>
 									<div class="card border-success align-self-center">
 										<?php if(!$cphoto): ?>
 											<img src="assets/img/avatar2.png" class="img-thumbnail img-fluid" height="350px" width="480px">
 										<?php else:  ?>
 											<img src="<?= 'assets/php/'.$cphoto; ?>" class="img-thumbnail img-fluid" height="350px" width="480px">
 										<?php endif; ?>
 									</div>
 								</div>
 							</div>
 							<!-- Profile Tab  End-->

 							<!-- Edit Profile Tab  Start-->
 							<div class="tab-pane container fade" id="editProfile">
 								<div class="card-deck">
 									<div class="card border-danger align-self-center">
 										<?php if(!$cphoto): ?>
 											<img src="assets/img/avatar2.png" class="img-thumbnail img-fluid" height="350px" width="408px">
 										<?php else:  ?>
 											<img src="<?= 'assets/php/'.$cphoto; ?>" class="img-thumbnail img-fluid" height="350px" width="408px">
 										<?php endif; ?>
 									</div>
 									<div class="card border-danger">
 										<form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="profile-update-form">
 											<input type="hidden" name="oldImage" value="<?= $cphoto; ?>">
 											<div class="form-group m-0">
 												<label for="profilePhoto" class="m-1">Upload Profile Image</label>
 												<input type="file" name="image" id="profilePhoto">	
 											</div>
 											<div class="form-group m-0">
 												<label for="name" class="m-1"><b>Name</b></label>
 												<input type="text" name="name" id="name" class="form-control" value="<?= $cname; ?>">
 											</div>

 											<div class="form-group m-0">
 												<label for="gender" class="m-1">Gender</label>
 												<select name="gender" id="gender" class="form-control">
 													<option value="" disabled <?php if($cgender == null){echo 'selected';} ?>>Select</option>
 													<option value="Male" <?php if($cgender == 'Male'){echo 'selected';}  ?>>Male</option>
 													<option value="Female" <?php if($cgender == 'Female'){echo 'selected';} ?>>Female</option>
 												</select>
 											</div>
 											<div class="form-group m-0">
 												<label for="dob" class="m-1">Date of Birth</label>
 												<input type="date" id="dob" name="dob" value="<?= $cdob; ?>" class="form-control">
 											</div>
 											<div class="form-group m-0">
 												<label for="phone" class="m-1">Phone Number</label>
 												<input type="tel" id="phone" name="phone" value="<?= $cphone; ?>" class="form-control" placeholder="ex. 09271169611">
 											</div>

 											<div class="form-group mt-2">
 												<input type="submit" name="profile_update" value="Update Profile" class="btn btn-danger btn-block" id="profileUpdateBtn">
 											</div>
 										</form>
 									</div>
 								</div>
 							</div>
 							<!-- Edit Profile Tab  End-->

 							<!-- Change Password Tab  Start-->
 							<div class="tab-pane container fade" id="changePass">
 								<div id="changepassAlert"></div>
 								<div class="card-deck">
 									<div class="card border-success">
 										<div class="card-header bg-success text-white text-center lead">
 											Change Password
 										</div>
 										<form action="#" method="post" class="px-3 mt-2" id="change-pass-form">
 											<div class="form-group">
 												<label for="currpass"><b>Enter Your Current Password</b></label>
 												<input type="password" name="currpass" placeholder="Current Password" class="form-control form-control-lg" id="currpass" required minlength="5">
 											</div>
 											<div class="form-group">
 												<label for="newpass"><b>Enter Your New Password</b></label>
 												<input type="password" name="newpass" placeholder="New Password" class="form-control form-control-lg" id="newpass" required minlength="5">
 											</div>
 											
 											<div class="form-group">
 												<label for="cnewpass"><b>Confirm Your New Password</b></label>
 												<input type="password" name="cnewpass" placeholder="Confirmt Password" class="form-control form-control-lg" id="cnewpass" required minlength="5">
 											</div>
 											<div class="form-group">
 												<p id="changepassError" class="text-danger"></p>
 											</div>

 											<div class="form-group">
 												<input type="submit" name="changepass" value="Change Password" class="btn bg-success border-success btn-primary btn-block btn-lg" id="changePassBtn">
 											</div>
 										</form>
 									</div>

 									<div class="card border-success align-self-center">
 										<img src="assets/img/cvsu.png" class="img-thumbnail img-fluid" width="408px">
 									</div>
 								</div>
 							</div>
 							<!-- Change Password Tab  End-->
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 	<?php else: ?>
			 	
				 <h1 class="text-center text-white bg-success mt-5 mb-3">Verify Your Account first to Edit Profile</h1>
										 
		<?php endif; ?>
	
<div class="footer">
	<img src="assets/img/cvsu.png" width="60" height="60" alt="">
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		// Fetch Notif of User
		fetchNotification();
		function fetchNotification(){
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { action: 'fetchNotification' },
				success:function(response){
					//console.log(response);
					$("#showAllNotif").html(response);
					
					
				}
			});

		}

		//Profile Ajax
		$("#profile-update-form").submit(function(e){
			e.preventDefault();

			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				processData: false,
				contentType: false,
				cache: false,
				data: new FormData(this),
				success:function(response){
					location.reload();
				}
			});
		});

		//Change Password Ajax
		$("#changePassBtn").click(function(e){
			if($("#change-pass-form")[0].checkValidity()){
				e.preventDefault();
				$("#changePassBtn").val('Please Wait');

				if($("#newpass").val() != $("#cnewpass").val()){
					$("#changepassError").text('* Password did not matched!');
					$("#changePassBtn").val('Change Password');
				}
				else{
					$.ajax({
						url: 'assets/php/process.php',
						method: 'post',
						data: $("#change-pass-form").serialize()+'&action=change_pass',
						success:function(response){
							$("#changepassAlert").html(response);
							$("#changePassBtn").val('Change Password');
							$("#changepassError").text('');
							$("#change-pass-form")[0].reset();
						}

					})
				}

			}
		});

		//Verify Email
		$("#verify-email").click(function(e){
			e.preventDefault();
			$(this).text('Please Wait');


			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { action: 'verify_email'},
				success:function(response){
					$("#verifyEmailAlert").html(response);
					$("#verify-email").text('Verify Now');
				}
			})
		});

		//FUTUREDATE
		$(function(){
			var dtToday = new Date();

			var month = dtToday.getMonth() + 1;
			var day = dtToday.getDate();
			var year = dtToday.getFullYear();

			if(month < 10)
				month = '0' + month.toString();
			if(day < 10)
				day = '0' + day.toString();

			var maxDate = year + '-' + month + '-' + day;    
			$('#dob').attr('max', maxDate);
		});
	});

	
</script>
</body>
</html>

