<?php 
require_once 'assets/php/header.php';
 ?>
<?php if($verified == 'Verified!'): ?>
 <div class="container-fluid">
 	<div class="row">
 		<div class="col-xl-12">
 			
 				

 			<h4 class="text-center text-light mt-3">Add Student Records Here</h4>
 		</div>
 	</div>
	
	<!-- START STUDENT RECORDS TABLE -->
 	<div class="card border-success">
 		<h5 class="card-header bg-success d-flex justify-content-between">
			<span class="text-light font-weight-bold lead align-self-center" type="button" data-toggle="collapse" data-target="#collapse-incident" aria-expanded="true" aria-controls="collapse-incident">Incident Reports</span>
				<div class="btn-group dropleft">
					<button class="btn btn-light" type="button"  data-toggle="modal" data-target="#addRecordModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Incident</button>	
				</div>
		</h5>

		<div class="collapse" id="collapse-incident">
			<div class="card-body">
				<div class="table-responsive" id="showIncident"></div>
			</div>
		</div>
 	</div>

	<div class="card border-success mt-3">
 		<h5 class="card-header bg-success d-flex justify-content-between">
 			<span class="text-light font-weight-bold lead align-self-center" type="button" data-toggle="collapse" data-target="#collapse-consultation" aria-expanded="true" aria-controls="collapse-consultation">Consultation Reports</span>
				<div class="btn-group dropleft">
					<button class="btn btn-light" type="button"  data-toggle="modal" data-target="#addConsultationModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Consultation</button>
				</div>
		</h5>

		<div class="collapse" id="collapse-consultation">
			<div class="card-body">
				<div class="table-responsive" id="showConsultation"></div>
			</div>
		</div>
 	</div>

	<div class="card border-success mt-3">
 		<h5 class="card-header bg-success d-flex justify-content-between">
 			<span class="text-light font-weight-bold lead align-self-center" type="button" data-toggle="collapse" data-target="#collapse-acceptance" aria-expanded="true" aria-controls="collapse-acceptance">Acceptance Slip</span>
				<div class="btn-group dropleft">
					<button class="btn btn-light" type="button"  data-toggle="modal" data-target="#addAcceptanceModal"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Acceptance</button>
				</div>
		</h5>

		<div class="collapse" id="collapse-acceptance">
			<div class="card-body">
				<div class="table-responsive" id="showAcceptance"></div>
			</div>
		</div>
 	</div>
	<!-- END STUDENT RECORDS TABLE -->
	
 </div>
<?php else: ?>
	<div class="alert-danger alert-dismissible text-center mt-5 m-0">
		<h2><strong class="align-self-center">Your Account is Not Verified!<br> Contact an Admin to verifiy your account<br>Contact Ma'am Nuestro or Sir Dizon!</strong></h2>
	</div>							
<?php endif; ?>

 <!--Start Add Incident Record -->
<div class="modal fade" id="addRecordModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Add New Incident Report</h4>
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

 <!--End Add Incident Record -->

 <!--Start Add Consulation Record -->
 <div class="modal fade" id="addConsultationModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Add New Consultation Slip</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
	
				<div class="modal-body">
					<form action="#" method="post" id="add-consult-form" class="px-3 form-floating">
					<input type="hidden" name="rectype" value="Consultation" ></input>
						<div class="d-flex justify-content-xl-between">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Client:</label>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box1" value="Student">
								<label class="form-check-label" for="flexCheckDefault">Student</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box1" value="Faculty">
								<label class="form-check-label" for="flexCheckDefault">Faculty</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box1" value="Staff">
								<label class="form-check-label" for="flexCheckDefault">Staff</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box1" value="Parent">
								<label class="form-check-label" for="flexCheckDefault">Parent</label>
								</div>
								<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Date of Consultation</label>
								<input type="date" name="date-of-consult" id="date-of-consult" class="form-control input-sm"required></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 15px">Name of Client</label>
							<input type="text" name="client-name" class="form-control input-sm" placeholder="Name of Client" required></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Name of Org/ Institution</label>
							<input type="text" name="client-org" class="form-control input-sm" placeholder="Name of Org / Inst." required></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Client ID Number</label>
							<input type="number" pattern="[0-9]+" name="client-id" class="form-control input-sm" placeholder="ID number of Client" required></input>
			 				</div>
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 15px">Time Started</label>
							<input type="time" name="time-started" class="form-control input-sm" required></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Time Ended</label>
							<input type="time" name="time-ended" class="form-control input-sm" required></input>
			 				</div>
			 			</div>

						
						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Purpose</label>
						<textarea name="purpose"  class="form-control form-control-lg" placeholder="Purpose" rows="6" required></textarea>							
						</div>	

						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Action Taken / Remarks</label>
						<textarea name="action-taken"  class="form-control form-control-lg" placeholder="Write your action" rows="6" required></textarea>							
						</div>

						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 20px">Recorded By:</label>
						<input type="text" name="recordedBy" value = "<?= $cname; ?>" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>

						<div class="form-group mt-4">
							<input type="submit" name="addrecord" id="addConsultBtn" value="Add Record" class="btn btn-success btn-block btn-lg"></input>
						</div>
					</form>
				</div>
		</div>
	</div>
</div>

 <!--End Add Consultation Record -->

 <!--Start Edit Consulation Record -->
 <div class="modal fade" id="editConsultModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Edit Consultation Slip</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="edit-consult-form" class="px-3 form-floating">
					<input type="hidden" name="cons_id" id="cons_id">
					<input type="hidden" name="rectype" value="Consultation" ></input>
						<div class="d-flex justify-content-xl-between">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Client:</label>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box3" id="box3" value="Student">
								<label class="form-check-label" for="flexCheckDefault">Student</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box3" id="box3" value="Faculty">
								<label class="form-check-label" for="flexCheckDefault">Faculty</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box3" id="box3" value="Staff">
								<label class="form-check-label" for="flexCheckDefault">Staff</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box3" id="box3" value="Parent">
								<label class="form-check-label" for="flexCheckDefault">Parent</label>
								</div>
								<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px" >Date of Consultation</label>
								<input type="date" name="date-of-consult3" id="date-of-consult3" class="form-control input-sm"required></input>
			 				</div>	
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 15px">Name of Client</label>
							<input type="text" name="client-name3" id="client-name3" class="form-control input-sm" placeholder="Name of Client" required></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Name of Org / Institution</label>
							<input type="text" name="client-org3" id="client-org3" class="form-control input-sm" placeholder="Name of Client" required></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Client ID Number</label>
							<input type="number" pattern="[0-9]+" id="client-id3" name="client-id" class="form-control input-sm" placeholder="ID number of Client" required></input>
							
			 				</div>
							 <div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 15px">Time Started</label>
							<input type="time" name="time-started3" id="time-started3" class="form-control input-sm" required></input>
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Time Ended</label>
							<input type="time" name="time-ended3" id="time-ended3" class="form-control input-sm" required></input>
			 				</div>
			 			</div>

						
						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Purpose</label>
						<textarea name="purpose3"  class="form-control form-control-lg" id="purpose3" placeholder="Purpose" rows="6" required></textarea>							
						</div>	

						<div class="mt-2">
						<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Action Taken / Remarks</label>
						<textarea name="action-taken3"  class="form-control form-control-lg" id="action-taken3" placeholder="Write your action" rows="6" required></textarea>							
						</div>

						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 20px">Recorded By:</label>
							<input type="text" name="recordedBy3" class="form-control form-control-lg" id="recordedBy3" placeholder="Enter Name" disabled></input>

						<div class="form-group mt-4">
							<input type="submit" name="addrecord" id="editConsultBtn" value="Update Record" class="btn btn-success btn-block btn-lg"></input>
						</div>
					</form>
				</div>
		</div>
	</div>
</div>
<!--End Edit Consultation Record -->

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
					<input type="hidden" name="rectype" value="Consultation" ></input>
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
							<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Client ID Number</label>
							<input type="number" pattern="[0-9]+" id="client-id2" name="client-id" class="form-control input-sm" placeholder="ID number of Client" disabled></input>
							
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

<!-- Start Add Acceptance Slip -->
<div class="modal fade" id="addAcceptanceModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Add New Acceptance Slip</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="add-acceptance-form" class="px-3 form-floating">
					<input type="hidden" name="rectype" value="Acceptance" ></input>
						<div class="d-flex justify-content-xl-end">
							<div class="mt-2">
								<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Date</label>
								<input type="date" name="date-reported" id="date-acceptance" class="form-control input-sm"required></input>
			 				</div>
			 			</div>

						
						<div class= "d-flex justify-content-lg-start mt-2">
							<div>
								<label style="font-size: 20px">The student, Mr/Ms.</label>
			 				</div>
							<div>
								<input type="text" name="student-name" class="form-control input-sm" required></input>	
			 				</div>				
						</div>	

						<div class= "d-flex justify-content-lg-between mt-2">
							<label style="font-size: 20px">was referred to the Guidance Office for a minor violation:</label>					
						</div>

							<div>
								<div class="form-check" required>
								<input class="form-check-input" type="radio" name="box2" value="No ID">
								<label class="form-check-label" for="flexCheckDefault">No ID</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box2" value="Not Wearing Proper Uniform (P.E, t-shirt, unprescribed shoes)">
								<label class="form-check-label" for="flexCheckDefault">Not Wearing Proper Uniform (P.E, t-shirt, unprescribed shoes)</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box2" value="Not in proper uniform (civilian attire)">
								<label class="form-check-label" for="flexCheckDefault">Not in proper uniform (civilian attire)</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box2" value="Tardiness/Late">
								<label class="form-check-label" for="flexCheckDefault">Tardiness/Late</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box2" value="Use of mobile phone inside classroom">
								<label class="form-check-label" for="flexCheckDefault">Use of mobile phone inside classroom</label>
			 					</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box2" value="Untoward behavior">
								<label class="form-check-label" for="flexCheckDefault">Untoward behavior</label>
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
								<input type="text" name="allow-class" class="form-control input-sm" required></input>					
			 				</div>
						</div>

						<div class= "d-flex justify-content-lg-between mt-2">
							<div>
								<label style="font-size: 20px">Please allow the student to get his/her phone back:&nbsp;</label>
			 				</div>
							<div>
								<input type="text" name="allow-phone" class="form-control input-sm" required></input>					
			 				</div>
						</div>

						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Student Number:</label>
						<input type="number" pattern="[0-9]+" name="studentNum" class="form-control form-control-l" placeholder="Enter Student Number" required></input>
						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Recorded By:</label>
						<input type="text" name="recordedBy" value = "<?= $cname; ?>" class="form-control form-control-l" placeholder="Enter Name" disabled></input>
						
						<div class="form-group mt-4">
							<input type="submit" name="addacceptance" id="addAcceptanceBtn" value="Add Record" class="btn btn-success btn-block btn-lg"></input>
						</div>
					</form>
				</div>
		</div>
	</div>
</div>
<!-- End Add Acceptance Slip -->

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
					<input type="hidden" name="rectype" value="Acceptance" ></input>
						<div class="d-flex justify-content-xl-end">
							<div class="mt-2">
								<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Date</label>
								<input type="date" name="date-reported" id="date-acceptance2" class="form-control input-sm" disabled></input>
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

						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Student Number:</label>
						<input type="number" pattern="[0-9]+" id="student_num2" name="studentNum" class="form-control form-control-l" placeholder="Enter Student Number" disabled></input>
						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Recorded By:</label>
						<input type="text" name="recordedBy" id="recordedBy" value = "<?= $cname; ?>" class="form-control form-control-l" placeholder="Enter Name" disabled></input>

						
					</form>
				</div>
		</div>
	</div>
</div>
<!-- End View Acceptance Slip -->

<!-- Start Edit Acceptance Slip -->
<div class="modal fade" id="EditAcceptanceModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
				<div class="modal-header bg-success">
					<h4 class="modal-title text-light">Edit Acceptance Slip</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
 		
				<div class="modal-body">
					<form action="#" method="post" id="edit-acceptance-form" class="px-3 form-floating">
					<input type="hidden" name="acc_id" id="acc_id">
					<input type="hidden" name="rectype" value="Acceptance" ></input>
						<div class="d-flex justify-content-xl-end">
							<div class="mt-2">
								<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Date</label>
								<input type="date" name="date-reported" id="date-acceptance3" class="form-control input-sm"required></input>
			 				</div>
			 			</div>

						
						<div class= "d-flex justify-content-lg-start mt-2">
							<div>
								<label style="font-size: 20px">The student, Mr/Ms.</label>
			 				</div>
							<div>
								<input type="text" name="student-name" id="student-name" class="form-control input-sm" required></input>	
			 				</div>				
						</div>	

						<div class= "d-flex justify-content-lg-between mt-2">
							<label style="font-size: 20px">was referred to the Guidance Office for a minor violation:</label>					
						</div>

							<div>
								<div class="form-check" required>
								<input class="form-check-input" type="radio" name="box" id="box" value="No ID">
								<label class="form-check-label" for="flexCheckDefault">No ID</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box" id="box" value="Not Wearing Proper Uniform (P.E, t-shirt, unprescribed shoes)">
								<label class="form-check-label" for="flexCheckDefault">Not Wearing Proper Uniform (P.E, t-shirt, unprescribed shoes)</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box" id="box" value="Not in proper uniform (civilian attire)">
								<label class="form-check-label" for="flexCheckDefault">Not in proper uniform (civilian attire)</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box" id="box" value="Tardiness/Late">
								<label class="form-check-label" for="flexCheckDefault">Tardiness/Late</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box" id="box" value="Use of mobile phone inside classroom">
								<label class="form-check-label" for="flexCheckDefault">Use of mobile phone inside classroom</label>
			 					</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="box" id="box" value="Untoward behavior">
								<label class="form-check-label" for="flexCheckDefault">Untoward behavior</label>
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
								<input type="text" name="allow-class" id="allow-class" class="form-control input-sm" required></input>					
			 				</div>
						</div>

						<div class= "d-flex justify-content-lg-between mt-2">
							<div>
								<label style="font-size: 20px">Please allow the student to get his/her phone back:&nbsp;</label>
			 				</div>
							<div>
								<input type="text" name="allow-phone" id="allow-phone" class="form-control input-sm" required></input>					
			 				</div>
						</div>

						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Student Number:</label>
						<input type="number" pattern="[0-9]+" id="student_num2" name="studentNum" class="form-control form-control-l" placeholder="Enter Student Number" required></input>
						<label class="badge badge-success mt-2" style="font-weight: bold;font-size: 15px">Recorded By:</label>
						<input type="text" name="recordedBy" id="recordedBy2" value = "<?= $cname; ?>" class="form-control form-control-l" placeholder="Enter Name" disabled></input>
						

						<div class="form-group mt-4">
							<input type="submit" name="editacceptance" id="editAcceptanceBtn" value="Update Record" class="btn btn-success btn-block btn-lg"></input>
						</div>
					</form>
				</div>
		</div>
	</div>
</div>
<!-- End Edit Acceptance Slip -->


<!-- Edit Incident Record Start -->
<div class="modal fade" id="editRecordModal">
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
							<input id="noted_by" type="text" name="notedBy" class="form-control form-control-lg" placeholder="Enter Name" disabled></input>
			 				</div>
			 			</div>

						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Student Number:</label>
							<input id="student_num4" type="number" pattern="[0-9]+" size="9" name="student_num4" class="form-control form-control-lg" placeholder="Enter Student Number" required></input>
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
						<input type="hidden" name="rectype" value="Incident" ></input>
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

						<div class="d-flex justify-content-xl-between mt-2">
							<div>
							<label class="badge badge-success" style="font-weight: bold;font-size: 20px">Student Number:</label>
							<input id="student_num3" type="number" pattern="[0-9]+" size="9" name="student_num3" class="form-control form-control-lg" placeholder="Enter Student Number" disabled></input>
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
<div class="footer">
	<img src="assets/img/cvsu.png" width="60" height="60" alt="">
</div>




<!--<h1><?= basename($_SERVER['PHP_SELF']); ?></h1> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(document).ready(function(){

		// Add New Record Ajax
		
		$("#addIncidentBtn").click(function(e){
			if($("#add-incident-form")[0].checkValidity()){
				e.preventDefault();

				//$("#addIncidentBtn").val('Processing...');

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#add-incident-form").serialize()+'&action=add_incident',
					success: function(response){
						$("#add-incident-form")[0].reset();
						$("#addRecordModal").modal('hide');
						console.log(response);
						Swal.fire({
							title: 'Record Added Succesfully',
							type: 'success'
						});
						
						
						displayAllIncident();
					}
				});
			}
		});

		// Add New Consultation Ajax
		
		$("#addConsultBtn").click(function(e){
			if($("#add-consult-form")[0].checkValidity()){
				e.preventDefault();

				//$("#addIncidentBtn").val('Processing...');

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#add-consult-form").serialize()+'&action=add_consultation',
					success: function(response){
						$("#add-consult-form")[0].reset();
						$("#addConsultationModal").modal('hide');
						console.log(response);
						Swal.fire({
							title: 'Record Added Succesfully',
							type: 'success'
						});
						
						
						displayAllConsultation();
					}
				});
			}
		});

		// Add Acceptance Ajax

		$("#addAcceptanceBtn").click(function(e){
			if($("#add-acceptance-form")[0].checkValidity()){
				e.preventDefault();

				//$("#addIncidentBtn").val('Processing...');

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#add-acceptance-form").serialize()+'&action=add_acceptance',
					success: function(response){
						$("#add-acceptance-form")[0].reset();
						$("#addAcceptanceModal").modal('hide');
						console.log(response);
						Swal.fire({
							title: 'Record Added Succesfully',
							type: 'success'
						});
						
						
						displayAllAcceptance();
					}
				});
			}
		});

		

		//Edit Incident Record Modal
		fetchRecordType()
		$("body").on("click", ".InceditBtn", function(e){
			e.preventDefault();

			edit_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { edit_id: edit_id },
				success:function(response){
					data = JSON.parse(response);
					console.log(data)
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
					
				}
			});
		});

		// Edit Incident Record Ajax
		$("#editRecordBtn").click(function(e){
			if($("#edit-incident-form")[0].checkValidity()){
				e.preventDefault();

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#edit-incident-form").serialize()+"&action=update_incident",
					success:function(response){
						Swal.fire({
							title: 'Record Updated Succesfully',
							type: 'success'
						});
						$("#edit-incident-form")[0].reset();
						$("#editRecordModal").modal('hide');
						displayAllIncident()
					}

				});
			}
		});

		// Delete Incident Record
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
			  		url: 'assets/php/process.php',
			  		method: 'post',
			  		data: { inc_del: inc_del },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'	
			      )
				  displayAllIncident()

			  	}
			  	});
			  }
			})
		});

		// Delete Consultation Record
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
			  		url: 'assets/php/process.php',
			  		method: 'post',
			  		data: { cons_del: cons_del },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'	
			      )
				  displayAllConsultation()

			  	}
			  	});
			  }
			})
		});
		// Delete Acceptance Record
		$("body").on("click", ".AccedeleteBtn", function(e){
		e.preventDefault();
		acce_del = $(this).attr('id');

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
			  		data: { acce_del: acce_del },
			  		success: function(response){
			  		Swal.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'	
			      )
				  displayAllAcceptance()

			  	}
			  	});
			  }
			})
		});


		
		//Submit Edit Consultation
		$("#editConsultBtn").click(function(e){
			if($("#edit-consult-form")[0].checkValidity()){
				e.preventDefault();

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#edit-consult-form").serialize()+"&action=update_consultation",
					success:function(response){
						console.log(data);
						Swal.fire({
							title: 'Record Updated Succesfully',
							type: 'success'
						});
						
						$("#edit-consult-form")[0].reset();
						$("#editConsultModal").modal('hide');
						displayAllConsultation()
					}

				});
			}
		});

		//Edit Consultation Record Modal
		fetchRecordType()
		$("body").on("click", ".ConseditBtn", function(e){
			e.preventDefault();

			edit_consult = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { edit_consult: edit_consult },
				success:function(response){
					data = JSON.parse(response);
					$("#cons_id").val(data.id);
					$("#title").val(data.title);
					$("#box1").val(data.client);
					$("#date-of-consult3").val(data.date_consultation);
					$("#client-id3").val(data.student_num);
					$("#client-name3").val(data.name_client);
					$("#client-org3").val(data.name_org);
					$("#time-started3").val(data.time_started);
					$("#time-ended3").val(data.time_ended);
					$("#purpose3").val(data.purpose);
					$("#action-taken3").val(data.action_taken);
					$("#recordedBy3").val(data.recorded_by);
					
				}
			});
		});
		

		// View Incident Record
		$("body").on("click", ".IncinfoBtn", function(e){
			e.preventDefault();

			incident_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { incident_id: incident_id },
				success:function(response){
					data = JSON.parse(response);
					console.log(data);
					$("#inc_id2").val(data.id);
					$("#inc_title").text(data.title + ' - ' + data.reported_by);
					$("#date_reported2").val(data.time_reported);
					$("#date_incident2").val(data.time_incident);
					$("#persons_involved2").val(data.persons_involved);
					$("#witness_involved2").val(data.witness_involved);
					$("#desc_incident2").val(data.incident_description);
					$("#reported_by2").val(data.reported_by);
					$("#noted_by2").val(data.noted_by);
					$("#student_num3").val(data.student_num);
					
					
				}
			});
		});

		// View Consult Record
		$("body").on("click", ".ConsinfoBtn", function(e){
			e.preventDefault();

			consult_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { consult_id: consult_id },
				success:function(response){
					data = JSON.parse(response);
					//console.log(data);
					$("#id").val(data.id);
					$("#consult_title").text(data.title + ' - ' + data.reported_by);
					$("#box2").val(data.client);
					$("#date-of-consult2").val(data.date_consultation);
					$("#client-id2").val(data.student_num);
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
				url: 'assets/php/process.php',
				method: 'post',
				data: { accept_id: accept_id },
				success:function(response){
					data = JSON.parse(response);
					//console.log(data);
					$("#id").val(data.id);
					$("#accept_title").text(data.title + ' - ' + data.reported_by);
					$("#date-acceptance2").val(data.date_reported);
					$("#student-name2").val(data.name_student);
					$("#student-violation2").val(data.student_violation);
					$("#allow-class2").val(data.allow_class);
					$("#allow-phone2").val(data.allow_phone);
					$("#student_num2").val(data.student_num);
					$("#recordedBy2").val(data.recorded_by);

				}
			});
		});

		// Edit Acceptance Record
		$("body").on("click", ".AcceditBtn", function(e){
			e.preventDefault();

			accept_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { accept_id: accept_id },
				success:function(response){
					data = JSON.parse(response);
					//console.log(data);
					$("#acc_id").val(data.id);
					$("#accept_title").text(data.title + ' - ' + data.reported_by);
					$("#date-acceptance3").val(data.date_reported);
					$("#student-name").val(data.name_student);
					$("#allow-class").val(data.allow_class);
					$("#allow-phone").val(data.allow_phone);
					$("#student_num").val(data.student_num);
					$("#recordedBy").val(data.recorded_by);
				}
			});
		});

		//Submit Edit Acceptance
		$("#editAcceptanceBtn").click(function(e){
			if($("#edit-acceptance-form")[0].checkValidity()){
				e.preventDefault();

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#edit-acceptance-form").serialize()+"&action=update_acceptance",
					success:function(response){
						Swal.fire({
							title: 'Record Updated Succesfully',
							type: 'success'
						});
						$("#edit-acceptance-form")[0].reset();
						$("#EditAcceptanceModal").modal('hide');
						displayAllAcceptance()
					}

				});
			}
		});

		displayAllIncident()
		function displayAllIncident(){
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { action: 'display_incidents'},
				success:function(response){
					
					$("#showIncident").html(response);

					$("#table").DataTable({
						
						order: [0, 'desc']
					});
				}
			})
		}

		displayAllConsultation()
		function displayAllConsultation(){
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { action: 'display_consultation'},
				success:function(response){
					
					$("#showConsultation").html(response);

					$("#table2").DataTable({
						
						order: [0, 'desc']
					});
				}
			})
		}

		displayAllAcceptance()
		function displayAllAcceptance(){
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { action: 'display_acceptance'},
				success:function(response){
					
					$("#showAcceptance").html(response);

					$("#table3").DataTable({
						
						order: [0, 'desc']
					});
				}
			})
		}
		

		// Get Record Types
		fetchRecordType()
		function fetchRecordType(){
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'fetchRecordType' },
			success:function(response){
				$("#record_type").html(response);
				$("#type_update").html(response);
				 
				
			}
		});
		}
		
		

		
		// Check if User is Logged Out
		$.ajax({
			url: 'assets/php/action.php',
			method: 'post',
			data: { action: 'checkUser' },
			success: function(response){
				if (response === 'bye'){
					window.location = 'index.php';
				}
			}
		})
		//LIMIT FUTURE DATES
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
			$('#date_rp').attr('max', maxDate);
			$('#date_inci').attr('max', maxDate);
			$('#date_reported').attr('max', maxDate);
			$('#date_incident').attr('max', maxDate);
			$('#date_reported2').attr('max', maxDate);
			$('#date-of-consult').attr('max', maxDate);
			$('#date-of-consult2').attr('max', maxDate);
			$('#date-of-consult3').attr('max', maxDate);
			$('#date-acceptance').attr('max', maxDate);
			$('#date-acceptance2').attr('max', maxDate);
			$('#date-acceptance3').attr('max', maxDate);
		
			
			
			
		});


	});
</script>
</body>
</html>

