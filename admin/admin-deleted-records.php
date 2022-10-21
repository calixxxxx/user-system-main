<?php 

	require_once 'assets/php/admin-header.php';


 ?>
 	<div class="row d-flex justify-content-center">
 		<div class="col-lg-11">
 			<div class="card my-2 border-success">
 				<div class="card-header bg-success text-white">
 					<h4 class="m-0">Archived Incident Records</h4>
 				</div>
				<div class="card-body">
					<div class="table-responsive" id="showDeletedIncident">
						<p class="text-center align-self-center lead">Please Wait</p>
					</div>
				</div>
 			</div>
 		</div>
 	</div>

	 <div class="row">
 		<div class="col-lg-12">
 			<div class="card my-2 border-success">
 				<div class="card-header bg-success text-white">
 					<h4 class="m-0">Archived Consultation Records</h4>
 				</div>
				<div class="card-body">
					<div class="table-responsive" id="showDeletedConsult">
						<p class="text-center align-self-center lead">Please Wait</p>
					</div>
				</div>
 			</div>
 		</div>
 	</div>

	 <div class="row">
 		<div class="col-lg-12">
 			<div class="card my-2 border-success">
 				<div class="card-header bg-success text-white">
 					<h4 class="m-0">Archived Acceptance Records</h4>
 				</div>
				<div class="card-body">
					<div class="table-responsive" id="showDeletedAccept">
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

 		//Fetch All Incident Deleted Ajax Request
 		fetchDeletedIncidentRecords();
 		function fetchDeletedIncidentRecords(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'IncidentDeletedRecords' },
 				success:function(response){
 					$("#showDeletedIncident").html(response);
 					$("#table5").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 		}
		 //Fetch All Consultation Deleted Ajax Request
 		fetchDeletedConsultRecords();
 		function fetchDeletedConsultRecords(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'ConsultDeletedRecords' },
 				success:function(response){
 					$("#showDeletedConsult").html(response);
 					$("#table6").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 		}
		 //Fetch All Acceptance Deleted Ajax Request
 		fetchDeletedAcceptRecords();
 		function fetchDeletedAcceptRecords(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'AcceptDeletedRecords' },
 				success:function(response){
 					$("#showDeletedAccept").html(response);
 					$("#table7").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 		}

		 //Restore Incident Deleted Record
 		$("body").on("click", ".restoreIncidentIcon", function(e){
		e.preventDefault();
		Inc_rev_id = $(this).attr('id');

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
			  		data: { Inc_rev_id: Inc_rev_id },
			  		success: function(response){
			  		Swal.fire(
			      'Restored!',
			      'Record has been restored.',
			      'success'	
			      )
			 	 fetchDeletedIncidentRecords();


			  	}
			  	});
			  }
			})

		});

		 //Restore Consult Deleted Record
 		$("body").on("click", ".restoreConsulttIcon", function(e){
		e.preventDefault();
		cons_rev_id = $(this).attr('id');

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
			  		data: { cons_rev_id: cons_rev_id },
			  		success: function(response){
			  		Swal.fire(
			      'Restored!',
			      'Record has been restored.',
			      'success'	
			      )
			 	 fetchDeletedConsultRecords();


			  	}
			  	});
			  }
			})

		});

		 //Restore Accept Deleted Record
 		$("body").on("click", ".restoreAcceptIcon", function(e){
		e.preventDefault();
		accept_rev_id = $(this).attr('id');

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
			  		data: { accept_rev_id: accept_rev_id },
			  		success: function(response){
			  		Swal.fire(
			      'Restored!',
			      'Record has been restored.',
			      'success'	
			      )
			 	 fetchDeletedAcceptRecords();


			  	}
			  	});
			  }
			})

		});

		//Permanent Incident Delete Record
		$("body").on("click", ".removeIncidentIcon", function(e){
		e.preventDefault();
		perm_inc_id = $(this).attr('id');

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
			  		data: { perm_inc_id: perm_inc_id },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted Permanently!',
			      'Record has been Deleted.',
			      'success'	
			      )
				  fetchDeletedIncidentRecords();


			  	}
			  	});
			  }
			})

		});
		
		//Permanent Consult Record
		$("body").on("click", ".removeConsultIcon", function(e){
		e.preventDefault();
		perm_cons_id = $(this).attr('id');

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
			  		data: { perm_cons_id: perm_cons_id },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted Permanently!',
			      'Record has been Deleted.',
			      'success'	
			      )
				fetchDeletedConsultRecords();


			  	}
			  	});
			  }
			})

		});

		//Permanent Acceptance Record
		$("body").on("click", ".removeAcceptIcon", function(e){
		e.preventDefault();
		perm_accept_id = $(this).attr('id');

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
			  		data: { perm_accept_id: perm_accept_id },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted Permanently!',
			      'Record has been Deleted.',
			      'success'	
			      )
			 	 fetchDeletedAcceptRecords();


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