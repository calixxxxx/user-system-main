<?php 

	require_once 'assets/php/admin-header.php';


 ?>
 	<div class="row">
 		<div class="col-lg-12">
 			<div class="card my-2 border-success">
 				<div class="card-header bg-success text-white">
 					<h4 class="m-0">Total Deleted Users</h4>
 				</div>
				<div class="card-body">
					<div class="table-responsive" id="showDeletedusers">
						<p class="text-center align-self-center lead">Please Wait</p>
					</div>
				</div>
 			</div>
 		</div>
 	</div>


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
 			fetchDeletedUsers();
 			function fetchDeletedUsers(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchDeletedUsers' },
 				success:function(respone){
 					$("#showDeletedusers").html(respone);
 					$("table").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 			}

 		//Restore Deleted
 		$("body").on("click", ".restoreUserIcon", function(e){
		e.preventDefault();
		res_id = $(this).attr('id');

			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, Restore it!'
			}).then((result) => {
			  if (result.value) {
			  	$.ajax({
			  		url: 'assets/php/admin-action.php',
			  		method: 'post',
			  		data: { res_id: res_id },
			  		success: function(response){
			  		Swal.fire(
			      'Restored!',
			      'User has been restored.',
			      'success'	
			      )
			 	 fetchDeletedUsers();


			  	}
			  	});
			  }
			})

		});

 		//Permanend Delete user
		$("body").on("click", ".removeUserIcon", function(e){
		e.preventDefault();
		rem_id = $(this).attr('id');

			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, Delete it permanently!'
			}).then((result) => {
			  if (result.value) {
			  	$.ajax({
			  		url: 'assets/php/admin-action.php',
			  		method: 'post',
			  		data: { rem_id: rem_id },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted Permanently!',
			      'User has been Deleted.',
			      'success'	
			      )
			 	 fetchDeletedUsers();


			  	}
			  	});
			  }
			})

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