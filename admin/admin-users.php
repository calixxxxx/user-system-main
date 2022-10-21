<?php 

	require_once 'assets/php/admin-header.php';

 ?>
 	<div class="row d-flex justify-content-center">
 		<div class="col-xl-11">
 			<div class="card my-2 border-success">
 				<div class="card-header bg-success text-white">
 					<h4 class="m-0">Total Registered Users</h4>
 				</div>
				<div class="card-body">
					<div class="table-responsive" id="showAllusers">
						<p class="text-center align-self-center lead">Please Wait</p>
					</div>
				</div>
 			</div>
 		</div>
 	</div>

 	<!-- Display Users Details -->
 	<div class="modal fade" id="showUsersDetails">
 		<div class="modal-dialog modal-dialog-centered mw-100 w-50">
 			<div class="modal-content">
 				<div class="modal-header">
				 <i class="fas fa-address-card fa-2x mt-1"></i>&nbsp; <h4 class="modal-title" id="getName"></h4>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>
 				<div class="modal-body">
 					<div class="card-deck">
 						<div class="card border-primary">
 							<div class="card-body mt-3">
							 		<div class="justify-content-beteen d-flex">
 									<i class="fas fa-envelope fa-lg mt-1"></i> <b>&nbsp;Email:&nbsp;</b><p id="getEmail"></p>
							 		</div>
									<div class="justify-content-beteen d-flex">
 									<i class="fas fa-mobile-alt fa-lg mt-1"></i> <b>&nbsp;Phone:&nbsp;</b><p placeholder="n/a" id="getPhone"></p>
							 		</div>
									<div class="justify-content-beteen d-flex">
 									<i class="fas fa-user fa-lg mt-1"></i> <b>&nbsp;Gender:&nbsp;</b><p id="getGender"></p>
							 		</div>
									<div class="justify-content-beteen d-flex">
 									<i class="fas fa-calendar fa-lg mt-1"></i> <b>&nbsp;Date of Birth:&nbsp;</b><p id="getDob"></p>
							 		</div>
									<div class="justify-content-beteen d-flex">
 									<i class="fas fa-calendar-day fa-lg mt-1"></i> <b>&nbsp;Create At:&nbsp;</b><p id="getCreated"></p>
							 		</div>
									<div class="justify-content-beteen d-flex">
 									<i class="fas fa-user-check fa-lg mt-1"></i> <b>&nbsp;Account Status:&nbsp;</b><p id="getVerfied"></p>
							 		</div>
 							</div>
 						</div>
 						<div class="card align-self-center" id="getImage"></div>
 							
 						
 					</div>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 				</div>
 			</div>
 		</div>
 	</div>

 	<!-- Send Message to User Start -->
 	<div class="modal fade" id="sendMessageModal">
 		<div class="modal-dialog modal-dialog-centered">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h4 class="modal-title">Send Message to this User</h4>
 					<button type="button" class="close" data-dismiss="modal">&times</button>
 				</div>
 				<div class="modal-body">
 					<form method="post" action="#" class="px-3" id="send-message-form">
 						<div class="form-group">
 							<textarea name="message" id="message" class="form-control" rows="6" placeholder="Write your Message" required></textarea>
 						</div>
 						<div class="form-group">
 							<input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-block" id="sendMessageBtn">
 						</div>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
 	<!-- Send Message to User End -->

 <!-- Footer Area -->
 			</div>
 		</div>
 	</div>
	<div class="footer">
	<img src="../assets/img/cvsu.png" width="60" height="60" alt="">
	</div>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 	<script type="text/javascript">
 	$(document).ready(function(){

 			//Fetch All Users Ajax Request
 			fetchAllUsers();
 			function fetchAllUsers(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchAllUsers' },
 				success:function(respone){
 					$("#showAllusers").html(respone);
 					$("table").DataTable({
 						responsive: true,
						order: [ 0, 'desc' ]
 					})
 				}
 			});
 			}

 		// Display Users Modal
 		$("body").on("click", ".userDetailsIcon", function(e){
 			e.preventDefault();

 			details_id = $(this).attr('id');
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				type: 'post',
 				data: { details_id: details_id },
 				success:function(respone){
 					data = JSON.parse(respone);
					if(data.verified == '1')
						data.verified = 'Verified';
					else 
					   data.verified = 'Not Verified';

 					$("#getName").text(data.name+' '+'(ID: '+data.id+')');
 					$("#getEmail").text(''+data.email);
 					$("#getPhone").text(''+data.phone);
 					$("#getGender").text(''+data.gender);
 					$("#getDob").text(''+data.dob);
 					$("#getCreated").text(''+data.created_at);
 					$("#getVerfied").text(''+data.verified);

 					if(data.photo != ''){
 						$("#getImage").html('<img src="../assets/php/'+data.photo+'"class="img-thumbnail img-fluid align-self-center" width-:350px">');
 					}
 					else{
 						$("#getImage").html('<img src="../assets/img/avatar2.png" class="img-thumbnail img-fluid align-self-center" width-:350px">'); 					}
 				}

 			});
 		});
 		//Delete
 		$("body").on("click", ".deleteUserIcon", function(e){
		e.preventDefault();
		del_id = $(this).attr('id');

			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.value) {
			  	$.ajax({
			  		url: 'assets/php/admin-action.php',
			  		method: 'post',
			  		data: { del_id: del_id },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'	
			      )
			 	fetchAllUsers();

			  	}
			  	});
			  }
			})

		});

		$("body").on("click", ".verifyUserIcon", function(e){
		e.preventDefault();
		verify_id = $(this).attr('id');

			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, Verify it!'
			}).then((result) => {
			  if (result.value) {
			  	$.ajax({
			  		url: 'assets/php/admin-action.php',
			  		method: 'post',
			  		data: { verify_id: verify_id },
			  		success: function(response){
			  		Swal.fire(
			      'Verified!',
			      'User has been verified.',
			      'success'	
			      )
			 	fetchAllUsers();

			  	}
			  	});
			  }
			})

		});

			var uid;
 			
 			$("body").on("click", ".sendMessageIcon", function(e){
 				uid = $(this).attr('id');
 				

 				
 			});
 		// Send Message to User
		$("#sendMessageBtn").click(function(e){
 				if($("#send-message-form")[0].checkValidity()){
 					let message = $("#message").val();
 					e.preventDefault();
 					$("#sendMessageBtn").val('Please Wait');

 					$.ajax({
 						url: 'assets/php/admin-action.php',
 						method: 'post',
 						data: { uid: uid, message: message},
 						success:function(respone){
 							
 							$("#sendMessageBtn").val('Send Reply');
 							$("#sendMessageModal").modal('hide');
 							$("#send-message-form")[0].reset();
 							Swal.fire(
 								'Sent!',
 								'Message sent successfully',
 								'success'
 							)
							fetchAllUsers();
 							
 						}
 					});
 				}
 			});

 		//Check Notification
 			checkNotification();
 			function checkNotification(){
 				$.ajax({
 					url: 'assets/php/admin-action.php',
 					method: 'post',
 					data: { action: 'checkNotification' },
 					success:function(response){
 						$("#checkNotification").html(response);
 					}
 				})
 			}
 	});

 		


 	</script>
 </body>
 </html>