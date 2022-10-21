<?php 

	require_once 'assets/php/admin-header.php';


 ?>
 	<div class="row">
 		<div class="col-xl-11">
 			<div class="card my-2 border-success">
 				<!-- <div class="card-header bg-success text-white">
 					<h4 class="m-0">Total Events</h4>
					 <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addEventModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add New Event </a>
 				</div> -->

				 	<h5 class="card-header bg-success d-flex justify-content-between">
			 			<span class="text-light font-weight-bold lead align-self-center">All Events</span>
			 			<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addEventModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add New Event </a>
			 		</h5>
				<div class="card-body">
					<div class="table-responsive" id="showAllEvents">
						<p class="text-center align-self-center lead">Please Wait</p>
					</div>
				</div>
 			</div>
 		</div>
 	</div>

 	<!-- Reply Events -->
 	<div class="modal fade" id="showReplyModal">
 		<div class="modal-dialog modal-dialog-centered">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h4 class="modal-title">Reply to this Event</h4>
 					<button type="button" class="close" data-dismiss="modal">&times</button>
 				</div>
 				<div class="modal-body">
 					<form method="post" action="#" class="px-3" id="event-reply-form">
 						<div class="form-group">
 							<textarea name="message" id="message" class="form-control" rows="6" placeholder="Write your comment" required></textarea>
 						</div>
 						<div class="form-group">
 							<input type="submit" name="submit" value="Send Reply" class="btn btn-primary btn-block" id="eventReplyBtn">
 						</div>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>

 	<!-- View Events -->
 	<div class="modal fade" id="showEventDetails">
 		<div class="modal-dialog modal-dialog-centered mw-50 w-50">
 			<div class="modal-content">
 				<div class="modal-header">
				 <i class="fas fa-sticky-note fa-2x mt-1"></i>&nbsp;<h4 class="modal-title" id="getEvent"></h4>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>
					<div class="modal-body">
						<div class="card-deck">
							<div class="card border-primary">
								<div class="card-body mt-3">
									
									<div class="justify-content-start d-flex">
									<b>&nbsp;Description:&nbsp;&nbsp;</b><p id="getSubject"></p>
									</div>
									<div class="justify-content-start d-flex">
									<b>&nbsp;Event Date:&nbsp;&nbsp;</b><p id="getDate"></p>
									</div>
									
								</div>
							</div>
						</div>
					</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 				</div>
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
						<input type="text" name="event" id="event" class="form-control form-control-lg" placeholder="Enter Event" required></input>
						<label style="font-weight: bold;font-size: 20px">Event Date:</label>
						<input type="date" name="when_at" id="when_at"  class="form-control form-control-lg" placeholder="Enter Event Date" required></input>
						<div class="form-group">
							<label style="font-weight: bold;font-size: 20px">Description:</label>
							<textarea name="subject" id="subject"  class="form-control form-control-lg" placeholder="Write your record" rows="6" required></textarea>
						</div>
			</div>
					<div class="form-group">
						<input type="submit" name="addevent" id="addEventBtn" value="Add Event" class="btn btn-success btn-block btn-lg"></input>
					</div>
				</form>
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

 			//Events of Users
 			fetchAllEvents();
 			function fetchAllEvents(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchAllEvents' },
 				success:function(respone){
 					
 					$("#showAllEvents").html(respone);
 					$("table").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 			}

 			// Get The Current Selected Row UID & FID
 			var uid;
 			var fid;
 			$("body").on("click", ".replyEventIcon", function(e){
 				uid = $(this).attr('id');
 				fid = $(this).attr('fid');

 				
 			});

 			//Send Event Reply to the User
 			$("#eventReplyBtn").click(function(e){
 				if($("#event-reply-form")[0].checkValidity()){
 					let message = $("#message").val();
 					e.preventDefault();
 					$("#eventReplyBtn").val('Please Wait');

 					$.ajax({
 						url: 'assets/php/admin-action.php',
 						method: 'post',
 						data: { uid: uid, message: message, fid: fid },
 						success:function(response){
 							$("#eventReplyBtn").val('Send Reply');
 							$("#showReplyModal").modal('hide');
 							$("#event-reply-form")[0].reset();
 							Swal.fire(
 								'Sent!',
 								'Reply sent successfully',
 								'success'
 							)
 							fetchAllEvents();
 						}
 					});
 				}
 			});
 			// View Events
 			$("body").on("click", ".eventDetailsIcon", function(e){
 			e.preventDefault();

 			view_event = $(this).attr('id');
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				type: 'post',
 				data: { view_event: view_event },
 				success:function(response){
 					console.log(response)
 					data = JSON.parse(response);
 					$("#getEvent").text(data.event+' '+'(ID: '+data.id+')');
 					$("#getSubject").text(''+data.subject);
 					$("#getDate").text(''+data.date);
 	
 					
 				}

 			});
 		});

 			// Delete Event
 			$("body").on("click", ".deleteEventIcon", function(e){
			e.preventDefault();
			event_id = $(this).attr('id');

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
				  		data: { event_id: event_id },
				  		success: function(response){
				  		
				  		Swal.fire(
				      'Deleted!',
				      'Event has been deleted.',
				      'success'	
				      )

				 	fetchAllEvents();

				  	}
				  	});
				  }
				})

			});

			//Add Event Ajax
			$("#addEventBtn").click(function(e){
			if($("#add-event-form")[0].checkValidity()){
				e.preventDefault();

				$(this).val('Please Wait...');

				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: $("#add-event-form").serialize()+'&action=event',
					success:function(response){
						
						console.log(response)
						$("#add-event-form")[0].reset();
						$("#addEventBtn").val('Add Event');
						$("#addEventModal").modal('hide');
						
						Swal.fire({
							title: 'Event Successfully Added',
							type: 'success'
						});

						fetchAllEvents();
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