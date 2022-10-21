<?php 
require_once 'assets/php/header.php';
 ?>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-xl-12 mt-5">
			<?php if($verified == 'Verified!'): ?>
				<div class="card border-success">
			 		<h5 class="card-header bg-success d-flex justify-content-between">
			 			<span class="text-light lead align-self-center">All Events</span>
			 			<!-- <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addEventModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add New Event </a> -->
			 		</h5>
			 		<div class="card-body">
			 			<div class="table-responsive" id="showEvents">
			 				
			 			</div>
			 		</div>
			 	</div>

			 	<!-- Start Add Event -->
			 	<div class="modal fade" id="addEventModal">
				 	<div class="modal-dialog modal-dialog-centered">
				 		<div class="modal-content">
				 			<div class="modal-header bg-success">
				 			<h4 class="modal-title text-light">Add New Event</h4>
				 			<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				 			</div>
				 		
				 		<div class="modal-body">
				 			<form action="#" method="post" id="add-event-form" class="px-3">
				 				
				 				
				 					<label style="font-weight: bold;font-size: 20px">Event Name</label>
				 					<input type="text" name="event" class="form-control form-control-lg" placeholder="Enter Event" required></input>
				 					<label style="font-weight: bold;font-size: 20px">Event Date:</label>
				 					<input type="date" name="when_at"  class="form-control form-control-lg" placeholder="Enter Event Date" required></input>
				 					<div class="form-group">
				 						<label style="font-weight: bold;font-size: 20px">Description:</label>
				 						<textarea name="subject"  class="form-control form-control-lg" placeholder="Write your record" rows="6" required></textarea>
				 					</div>
				 		</div>
				 				<div class="form-group">
				 					<input type="submit" name="addevent" id="addEventBtn" value="Add Event" class="btn btn-success btn-block btn-lg"></input>
				 				</div>
				 			</form>
				 		</div>
				 		
				 	</div>
				 </div>
				</div>

			 	<!-- End Add Event -->

			 	<!-- Start Edit Event  -->
			 	<div class="modal fade" id="editEventModal">
				 	<div class="modal-dialog modal-dialog-centered">
				 		<div class="modal-content">
				 			<div class="modal-header bg-success">
				 			<h4 class="modal-title text-light">Edit Event</h4>
				 			<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				 			</div>
				 		
				 		<div class="modal-body">
				 			<form action="#" method="post" id="edit-event-form" class="px-3">
				 				<input type="hidden" name="id" id="id">
				 				
				 				
				 					<label style="font-weight: bold;font-size: 20px">Event Name</label>
				 					<input type="text" name="event" id="event" class="form-control form-control-lg" placeholder="Enter Event" required></input>
				 					<label style="font-weight: bold;font-size: 20px">Event Date:</label>
				 					<input type="date" name="when_at" id="eventDate"  class="form-control form-control-lg" placeholder="Enter Event Date" required></input>
				 					<div class="form-group">
				 						<label style="font-weight: bold;font-size: 20px">Description:</label>
				 						<textarea name="subject" id="editDesc"  class="form-control form-control-lg" placeholder="Edit your Event" rows="6" required></textarea>
				 					</div>
				 		</div>
				 				<div class="form-group">
				 					<input type="submit" name="updateEvent" id="updateEventBtn" value="Edit Event" class="btn btn-success btn-block btn-lg"></input>
				 				</div>
				 			</form>
				 		</div>
				 		
				 	</div>
				 </div>
				</div>
			 	<!-- End Edit Event -->
			<?php else: ?>
				<h1 class="text-center text-white bg-success mt-5 mb-3">Verify Your Account First</h1>
					
			<?php endif; ?>

			<!-- Start Calender -->



			<!-- End Calendar -->
		
		</div>
	</div>
</div>

<div class="footer">
	<img src="assets/img/cvsu.png" width="60" height="60" alt="">
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>



<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>

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


		

		// Delete event
		$("body").on("click", ".deleteBtn", function(e){
		e.preventDefault();
		edel_id = $(this).attr('id');

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
			  		url: 'assets/php/process.php',
			  		method: 'post',
			  		data: { edel_id: edel_id },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted!',
			      'Your Event has been deleted.',
			      'success'	
			      )
			  	displayAllEvents();

			  	}
			  	});
			  }
			})

		});
		// Edit Event
		$("body").on("click", ".editEventBtn", function(e){
			e.preventDefault();

			edit_event = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { edit_event: edit_event },
				success:function(response){+
					console.log(response);
					data = JSON.parse(response);
					$("#id").val(data.id);
					$("#event").val(data.event);
					$("#eventDate").val(data.when_at);
					$("#editDesc").val(data.subject);
					
				}
			});
		});

		//Update Events
		$("#updateEventBtn").click(function(e){
			if($("#edit-event-form")[0].checkValidity()){
				e.preventDefault();

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#edit-event-form").serialize()+"&action=update_event",
					success:function(response){
						console.log(response);

						Swal.fire({
							title: 'Event Updated Succesfully',
							type: 'success'
						});
						$("#edit-event-form")[0].reset();
						$("#editEventModal").modal('hide');
						displayAllEvents();

					}

				});
			}
		});

		displayAllEvents()
		//Dispaly All Events
		function displayAllEvents(){
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { action: 'display_events'},
				success:function(response){
					$("#showEvents").html(response);
					$("table").DataTable({
						   responsive: true,

						order: [2, 'desc']
					});
				}
			})
		}
		// View Event
		$("body").on("click", ".EveinfoBtn", function(e){
			e.preventDefault();

			event_id = $(this).attr('id');

			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { event_id: event_id },

				success:function(response){
					data = JSON.parse(response);
					Swal.fire({
						title: '<strong> Event ID:'+data.id+'</strong>',
						type: 'info',
						//background: '#ced1d6',
						html: 
						
						'<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Event Event Name: </b>'+data.event+
						'<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Event Description: </b>'+data.subject+
						'<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Event Event Date: </b>'+data.date+
						'<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Event Date Created: </b>'+data.created_at,
						
						showCloseButton: true,
						
					});

				}
			});
		});
		
		
	
	});
</script>
</body>
</html>

