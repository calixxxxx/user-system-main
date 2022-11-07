<?php 
	require_once 'assets/php/admin-header.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<!-- START STUDENT RECORDS TABLE -->
<div class="card border-success">
 		<h5 class="card-header bg-success d-flex justify-content-between">
			<span class="text-light font-weight-bold lead align-self-center" type="button" data-toggle="collapse" data-target="#collapse-incident" aria-expanded="true" aria-controls="collapse-incident">All Incident Reports</span>
				
		</h5>

		<div class="collapse" id="collapse-incident">
				<div class="card-body">
				<button class="dt-button buttons-pdf buttons-html5" style="float: right;" data-button="incidentReport">PDF</button>
					<div class="" id="showIncident"></div>
				</div>
		</div>
 	</div>

	<div class="card border-success mt-3">
 		<h5 class="card-header bg-success d-flex justify-content-between">
 			<span class="text-light font-weight-bold lead align-self-center" type="button" data-toggle="collapse" data-target="#collapse-consultation" aria-expanded="true" aria-controls="collapse-consultation">All Consultation Reports</span>
				
		</h5>

		<div class="collapse" id="collapse-consultation">
			<div class="card-body">
				<button class="dt-button buttons-pdf buttons-html5" style="float: right;" data-button="consultationReport">PDF</button>
				<div class="table-responsive" id="showConsultation"></div>
			</div>
		</div>
 	</div>

	<div class="card border-success mt-3">
 		<h5 class="card-header bg-success d-flex justify-content-between">
 			<span class="text-light font-weight-bold lead align-self-center" type="button" data-toggle="collapse" data-target="#collapse-acceptance" aria-expanded="true" aria-controls="collapse-acceptance">All Acceptance Slip</span>
				
		</h5>

		<div class="collapse" id="collapse-acceptance">
			<div class="card-body">
				<button class="dt-button buttons-pdf buttons-html5" style="float: right;" data-button="acceptanceSlip">PDF</button>
				<div class="table-responsive" id="showAcceptance"></div>
			</div>
		</div>
	</div>

	<div class="card border-success mt-3">
 		<h5 class="card-header bg-success d-flex justify-content-between">
 			<span class="text-light font-weight-bold lead align-self-center" type="button" data-toggle="collapse" data-target="#collapse-referral" aria-expanded="true" aria-controls="collapse-referral">All Referral Slip</span>
				
		</h5>

		<div class="collapse" id="collapse-referral">
			<div class="card-body">
				<button class="dt-button buttons-pdf buttons-html5" style="float: right;" data-button="referralSlip">PDF</button>
				<div class="btn-group dropleft">
					<button class="btn btn-light" type="button"  data-toggle="modal" data-target="#addReferralModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Referral Slip</button>	
				</div>
				<div class="table-responsive" id="showReferral"></div>
			</div>
		</div>
	</div>
</div>
<!-- END STUDENT RECORDS TABLE -->

<!-- View Incident Record Start -->
<div class="modal fade" id="ViewRecordModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light" id="inc_title"></h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="view-incident-form" class="px-3 form-floating">
						<input type="hidden" name="rectype" value="Incident Record" ></input>
						<div class="d-flex justify-content-xl-between">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Date Reported</label>
							<input id="date_reported2" type="date" name="DTReported" class="form-control form-control-lg" placeholder="Select Date & Time" disabled></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Date Incident</label>
							<input id="date_incident2" type="date" name="DTIncident" class="form-control form-control-lg" placeholder="Select Date & Time" disabled></input>
			 				</div>
			 			</div>

						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Persons Involved</label>
							<input id="persons_involved2" type="text" name="personsInv" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>
			 				</div>	
							<div style=" text-align:right"> 
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px;">Witness Involved</label>
							<input id="witness_involved2" type="text" name="witnessInv" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>
			 				</div>
			 			</div>
						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Brief Description of the Incident</label>
						<textarea id="desc_incident2" name="description"  class="form-control form-control-lg" placeholder="Write your record" rows="6" disabled></textarea>							
			 			</div>
						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Reported By:</label>
							<input id="reported_by2" type="text" name="reportedBy" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Noted By:</label>
							<input id="noted_by2" type="text" name="notedBy" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>
			 				</div>
			 			</div>
					
						<!-- <div class="form-group mt-4">
							<input type="submit" name="editrecord" id="editRecordBtn" value="Update Record" class="btn btn-success btn-block btn-lg"></input>
						</div> -->
					</form>
				</div>
		</div>
	</div>
</div>
<!-- View Incident Record End -->

<!--Start View Consulation Record -->
<div class="modal fade" id="viewConsultModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">View Consultation Slip</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="view-consult-form" class="px-3 form-floating">
					<input type="hidden" name="rectype" value="Consultation Report" ></input>
						<div class="d-flex justify-content-xl-between">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Client:</label>
							<input type="text" name="box2" id="box2" class="form-control input-sm" placeholder="Client" disabled></input>
								<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px" >Date of Consultation</label>
								<input type="date" name="date-of-consult" id="date-of-consult2" class="form-control input-sm" disabled></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 15px">Name of Client</label>
							<input type="text" name="client-name" id="client-name2" class="form-control input-sm" placeholder="Name of Client" disabled></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Name of Org/ Institution</label>
							<input type="text" name="client-org" id="client-org2" class="form-control input-sm" placeholder="Name of Client" disabled></input>
							
			 				</div>
							 <div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 15px">Time Started</label>
							<input type="time" name="time-started" id="time-started2" class="form-control input-sm" disabled></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Time Ended</label>
							<input type="time" name="time-ended" id="time-ended2" class="form-control input-sm" disabled></input>
			 				</div>
			 			</div>

						
						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Purpose</label>
						<textarea name="purpose"  class="form-control form-control-lg" id="purpose2" placeholder="Purpose" rows="6" disabled></textarea>							
						</div>	

						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Action Taken / Remarks</label>
						<textarea name="action-taken"  class="form-control form-control-lg" id="action-taken2" placeholder="Write your action" rows="6" disabled></textarea>							
						</div>

						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 20px">Recorded By:</label>
							<input type="text" name="recordedBy" class="form-control form-control-lg" id="recordedBy2" placeholder="Enter Name" disabled></input>
					</form>
				</div>
		</div>
	</div>
</div>
<!--End View Consultation Record -->

<!-- Edit Incident Record Start -->
<div class="modal fade" id="editRecordModal2">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light" id="title">Edit Incident Report</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="edit-incident-form" class="px-3 form-floating">
						<input type="hidden"  name="inc_id" id="inc_id">
						<div class="d-flex justify-content-xl-between">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Date Reported</label>
							<input id="date_reported" type="date" name="DTReported" class="form-control form-control-lg" placeholder="Select Date & Time" required></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Date Incident</label>
							<input id="date_incident" type="date" name="DTIncident" class="form-control form-control-lg" placeholder="Select Date & Time" required></input>
			 				</div>
			 			</div>

						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Persons Involved</label>
							<input id="persons_involved" type="text" name="personsInv" class="form-control form-control-lg" placeholder="Enter Name" required></input>
			 				</div>	
							<div style=" text-align:right"> 
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px;">Witness Involved</label>
							<input id="witness_involved" type="text" name="witnessInv" class="form-control form-control-lg" placeholder="Enter Name" required></input>
			 				</div>
			 			</div>
						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Brief Description of the Incident</label>
						<textarea id="desc_incident" name="description"  class="form-control form-control-lg" placeholder="Write your record" rows="6" required></textarea>							
			 			</div>
						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Reported By:</label>
							<input id="reported_by" type="text" name="reportedBy" class="form-control form-control-lg" placeholder="Enter Name" required></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Noted By:</label>
							<input id="noted_by" type="text" name="incident_noted" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>
			 				</div>
			 			</div>

						<div class="d-flex justify-content-lg-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Student Number:</label>
							<input id="student_num4" type="number" pattern="[0-9]+" size="9" name="student_num4" class="form-control form-control-lg" placeholder="Enter Student Number" required></input>
							</div>
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Action Made:</label>
							<select id="action_made" name="action_made" class="form-control form-control-lg" data-select="report">
										
										<option value="No Action Yet" <?php if( $NoActionYet == 'No Action Yet'){echo 'selected';} ?>>No Action Yet</option>
										<option value="For Endorsement" <?php if( $ForEndo == 'For Endorsement'){echo 'selected';} ?>>For Endorsement</option>
										<option value="Counseled" <?php if( $Counseled == 'Counseled'){echo 'selected';} ?>>Counseled</option>
									</select>
			 				</div>	
			 			</div>
					
						<div class="form-group mt-4">
							<input type="submit" name="editrecord" id="editRecordBtn" value="Update Record" class="btn btn-success btn-block btn-lg"></input>
						</div>
					</form>
				</div>
		</div>
	</div>
</div>


<!-- Edit Incident Record Test End -->

<!-- Start View Acceptance Slip -->
<div class="modal fade" id="viewAcceptanceModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Acceptance Slip</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="view-acceptance-form" class="px-3 form-floating">
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="rectype" value="Acceptance Slip" ></input>
						<div class="d-flex justify-content-xl-end">
							<div class="mt-2">
								<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Date</label>
								<input type="date" name="date-reported" id="date-reported2" class="form-control input-sm" disabled></input>
			 				</div>
			 			</div>

						
						<div class= "d-flex justify-content-lg-start mt-2">
							<div>
								<label style="font-size: 20px">The student, Mr/Ms.</label>
			 				</div>
							<div>
								<input type="text" name="student-name" id="student-name2" class="form-control input-sm" disabled></input>	
			 				</div>				
						</div>	

						<div class= "d-flex justify-content-lg-between mt-2">
							<label style="font-size: 20px">was referred to the Guidance Office for a minor violation:</label>					
						</div>

							<div>
							<div>
								<input type="text" name="student-violation" id="student-violation2" class="form-control input-sm" disabled></input>	
			 				</div>
			 				</div>


						<div class= "d-flex justify-content-lg-between mt-2">
							<label style="font-size: 20px">With this, he/she was <b>COUNSELED</b> for the action taken and he/she consented to be more careful/uprightfuly next time.</label>					
						</div>

						<div class= "d-flex justify-content-lg-between mt-2">
							<div>
								<label style="font-size: 20px">Please admit him/her to your class today:&nbsp;</label>
			 				</div>
							<div>
								<input type="text" name="allow-class" id="allow-class2" class="form-control input-sm" disabled></input>					
			 				</div>
						</div>

						<div class= "d-flex justify-content-lg-between mt-2">
							<div>
								<label style="font-size: 20px">Please allow the student to get his/her phone back:&nbsp;</label>
			 				</div>
							<div>
								<input type="text" name="allow-phone" id="allow-phone2" class="form-control input-sm" disabled></input>					
			 				</div>
						</div>

						
					</form>
				</div>
		</div>
	</div>
</div>
<!-- End View Acceptance Slip -->

<!-- Start referral Slip -->
<!--Start Add Incident Record -->
<div class="modal fade" id="addReferralModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Add New Referral Slip</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="add-incident-form" class="px-3 form-floating">
						<input type="hidden" name="rectype" value="Incident" ></input>
						<div class="d-flex justify-content-xl-between">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Date Reported</label>
							<input type="date" name="DTReported" id="date_rp" class="form-control form-control-lg" placeholder="Select Date & Time" required></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Date of Incident</label>
							<input type="date" name="DTIncident" id="date_inci" class="form-control form-control-lg" placeholder="Select Date & Time" required></input>
			 				</div>
			 			</div>

						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Persons Involved</label>
							<input type="text" name="personsInv" class="form-control form-control-lg" placeholder="Enter Name" required></input>
			 				</div>	
							<div style=" text-align:right"> 
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px;">Witness Involved</label>
							<input type="text" name="witnessInv" class="form-control form-control-lg" placeholder="Enter Name" required></input>
			 				</div>
			 			</div>
						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Brief Description of the Incident</label>
						<textarea name="description"  class="form-control form-control-lg" placeholder="Write your record" rows="6" required></textarea>							
			 			</div>
						
						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Reported By:</label>
							<input type="text" name="reportedBy" class="form-control form-control-lg" placeholder="Enter Name" required></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Noted By:</label>
							<input type="text" name="notedBy" value="<?= $cname; ?>" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>
			 				</div>
			 			</div>

						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Student Number:</label>
							<input type="number" pattern="[0-9]+" size="9" name="studentNum" class="form-control form-control-lg" placeholder="Enter Student Number" required></input>
			 				</div>	
			 			</div>
					
						<div class="form-group mt-4">
							<input type="submit" name="addrecord" id="addIncidentBtn" value="Add Record" class="btn btn-success btn-block btn-lg"></input>
						</div>
					</form>
				</div>
		</div>
	</div>
</div>
<!-- End referral Slip -->
	

 <!-- Footer Area -->
 			</div>
 		</div>
 	</div>
	<div class="footer">
	<img src="../assets/img/cvsu.png" width="60" height="60" alt="">
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
 	<script type="text/javascript">
 		$(document).ready(function(){

 			//Fetch All Records Ajax Request
 			fetchIncident();
 			function fetchIncident(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchIncident' },
 				success:function(response){
					// console.log(response);
 					$("#showIncident").html(response);
 					$("#table").DataTable({
 						order: [0, 'desc']
 					});
 				}
 			});
 			}
			fetchConsultation();
 			function fetchConsultation(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchConsultation' },
 				success:function(response){
 					$("#showConsultation").html(response);
 					$("#table2").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 			}

			 fetchAcceptance();
 			function fetchAcceptance(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchAcceptance' },
 				success:function(response){
 					$("#showAcceptance").html(response);
 					$("#table3").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 			}

			 fetchReferral();
 			function fetchReferral(){
 			$.ajax({
 				url: 'assets/php/admin-action.php',
 				method: 'post',
 				data: { action: 'fetchReferral' },
 				success:function(response){
 					$("#showReferral").html(response);
 					$("#table4").DataTable({
 						order: [0, 'desc']
 					})
 				}
 			});
 			}

 			//Delete Incident Record
 			$("body").on("click", ".IncdeleteBtn", function(e){
			e.preventDefault();
			inc_del = $(this).attr('id');

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
				  		data: { inc_del: inc_del },
				  		success: function(response){
				  		
				  		Swal.fire(
				      'Deleted!',
				      'Record has been deleted.',
				      'success'	
				      )

				 	fetchIncident();

				  	}
				  	});
				  }
				})

			});

			//Delete Consult Record
			$("body").on("click", ".ConsdeleteBtn", function(e){
			e.preventDefault();
			cons_del = $(this).attr('id');

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
				  		data: { cons_del: cons_del },
				  		success: function(response){
				  		
				  		Swal.fire(
				      'Deleted!',
				      'Record has been deleted.',
				      'success'	
				      )

					  fetchConsultation();

				  	}
				  	});
				  }
				})

			});

			//Delete Acceptance Record
			$("body").on("click", ".AccdeleteBtn", function(e){
			e.preventDefault();
			accept_del = $(this).attr('id');

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
				  		data: { accept_del: accept_del },
				  		success: function(response){
				  		
				  		Swal.fire(
				      'Deleted!',
				      'Record has been deleted.',
				      'success'	
				      )

					  fetchAcceptance();

				  	}
				  	});
				  }
				})

			});

		// View Incident Record
		fetchIncident();
		$("body").on("click", ".IncinfoBtn", function(e){
			e.preventDefault();

			incident_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/admin-action.php',
				method: 'post',
				data: { incident_id: incident_id },
				success:function(response){
					data = JSON.parse(response);
					$("#inc_id2").val(data.id);
					$("#inc_title").text(data.title + ' - ' + data.reported_by);
					$("#date_reported2").val(data.time_reported);
					$("#date_incident2").val(data.time_incident);
					$("#persons_involved2").val(data.persons_involved);
					$("#witness_involved2").val(data.witness_involved);
					$("#desc_incident2").val(data.incident_description);
					$("#reported_by2").val(data.reported_by);
					$("#noted_by2").val(data.noted_by);
				}
			});
		});
		// Edit Incident Button Ajax
		fetchIncident();
		$("body").on("click", ".InceditBtn", function(e){
			e.preventDefault();

			edit_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/admin-action.php',
				method: 'post',
				data: { edit_id: edit_id },
				success:function(response){
					data = JSON.parse(response);
					console.log(data);
					$("#inc_id").val(data.id);
					$("#title").val(data.title);
					$("#date_reported").val(data.time_reported);
					$("#date_incident").val(data.time_incident);
					$("#persons_involved").val(data.persons_involved);
					$("#witness_involved").val(data.witness_involved);
					$("#desc_incident").val(data.incident_description);
					$("#reported_by").val(data.reported_by);
					$("#noted_by").val(data.noted_by);
					$("#student_num4").val(data.student_num);
					$("#action_made").val(data.action_made);
					
				}
			});
		});

		// Edit Incident Record Ajax
		$("#editRecordBtn").click(function(e){
			if($("#edit-incident-form")[0].checkValidity()){
				e.preventDefault();

				$.ajax({
					url: 'assets/php/admin-action.php',
					method: 'post',
					data: $("#edit-incident-form").serialize()+"&action=update_incident",
					success:function(response){
						console.log(response)
						Swal.fire({
							title: 'Record Updated Succesfully',
							type: 'success'
						});
						$("#edit-incident-form")[0].reset();
						$("#editRecordModal2").modal('hide');
						fetchIncident();
						
					}

				});
			}
		});

		// View Consult Record
		$("body").on("click", ".ConsinfoBtn", function(e){
			e.preventDefault();

			consult_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/admin-action.php',
				method: 'post',
				data: { consult_id: consult_id },
				success:function(response){
					data = JSON.parse(response);
					$("#id").val(data.id);
					$("#consult_title").text(data.title + ' - ' + data.reported_by);
					$("#box2").val(data.client);
					$("#date-of-consult2").val(data.date_consultation);
					$("#client-name2").val(data.name_client);
					$("#client-org2").val(data.name_org);
					$("#time-started2").val(data.time_started);
					$("#time-ended2").val(data.time_ended);
					$("#purpose2").val(data.purpose);
					$("#action-taken2").val(data.action_taken);
					$("#recordedBy2").val(data.recorded_by);
				}
			});
		});

		// View Acceptance Record
		$("body").on("click", ".AccinfoBtn", function(e){
			e.preventDefault();

			accept_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/admin-action.php',
				method: 'post',
				data: { accept_id: accept_id },
				success:function(response){
					data = JSON.parse(response);
					$("#id").val(data.id);
					$("#accept_title").text(data.title + ' - ' + data.reported_by);
					$("#date-reported2").val(data.date_reported);
					$("#student-name2").val(data.name_student);
					$("#student-violation2").val(data.student_violation);
					$("#allow-class2").val(data.allow_class);
					$("#allow-phone2").val(data.allow_phone);
				}
			});
		});

		

		
		// Check Notification
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

    document.addEventListener('click', function(e) {
        e = e || window.event;
        var target = e.target || e.srcElement;
        let inputElements = document.querySelectorAll('input[type="search"]');
        var data = [];
        let keyword = null;
        let reportType = null;
        let isValidReport = false;
        switch(target.dataset.button) {
        	case "incidentReport":
        		keyword = inputElements[0].value;
        		let table1 = $("#table").DataTable().rows({search: 'applied'}).data();
        		for(var i = 0; i < table1.length; i++) {
        			data.push(table1[i]);
        		}
        		isValidReport = true;
        		break;
        	case "consultationReport":
        		keyword = inputElements[1].value;
        		let table2 = $("#table2").DataTable().rows({search: 'applied'}).data();
        		for(var i = 0; i < table2.length; i++) {
        			data.push(table2[i]);
        		}
        		isValidReport = true;
        		break;
        	case "acceptanceSlip":
        		keyword = inputElements[2].value;
        		let table3 = $("#table3").DataTable().rows({search: 'applied'}).data();
        		for(var i = 0; i < table3.length; i++) {
        			data.push(table3[i]);
        		}
        		isValidReport = true;
        		break;
        }
        if(!isValidReport) {
        	return;
        }
        reportType = target.dataset.button;
        console.log("Export " + reportType + "!");
        console.log(keyword);
        console.log(data);
        var json = JSON.stringify(data);

        window.open("../InfinityBrackets/index.php?report=" + reportType + "&keyword=" + keyword, "_blank");

   //  	var formData = new FormData();
   //      formData.append('reportType', reportType);
   //      formData.append('data', json);
	  //   $.ajax({
			// url: '../InfinityBrackets/index.php',
			// method: 'POST',
			// data: formData,
			// contentType: false,
			// processData: false,
			// success: function(response) {
			// 	console.log(response);
			// 	Swal.fire({
			// 		type: JSON.parse(response).status,
			// 		title: JSON.parse(response).title,
			// 		text: JSON.parse(response).message
			// 	});
			// }
	  //   });
    });
 	</script>
 </body>
 </html>