<?php 

require_once 'admin-db.php';
$admin = new Admin();
session_start();

// Handle Admin Login Ajax
if(isset($_POST['action']) && $_POST['action'] == 'adminLogin'){
	$username = $admin->test_input($_POST['username']);
	$password = $admin->test_input($_POST['password']);

	$hpassword = sha1($password);

	$loggedInAdmin = $admin->admin_login($username, $hpassword);
	
	if($loggedInAdmin != null){
		echo 'admin_login';
		$_SESSION['username'] = $username;
		
	}
	else{
		echo $admin->showMessage('danger','Username or Password is Incorrect');
	}
}

	//Handle Fetch All Users Ajax
	if(isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers'){
		$output = '';
		$data = $admin->fetchAllUsers(0);
		$path = '../assets/php/';

		if($data){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						
						<th data-visible="false">User ID</th>
						<th>Name</th>
						<th>E-Mail</th>
						<th>Phone</th>
						<th>Gender</th>
						<th>Verified</th>
						<th>Action</th>
						</tr>
						</thead>
						<tbody>';
				foreach ($data as $row) {
					if($row['photo'] != ''){
						$uphoto = $path.$row['photo'];
					}
					else{
						$uphoto = '../assets/img/avatar.png.';
					}

					if($row['verified'] == 1){
						$row['verified'] = 'Verified';
					}else{
						$row['verified'] = 'Not Verified';
					}
						
					$output .= '<tr>
									
									<td>'.$row['id'].'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['phone'].'</td>
									<td>'.$row['gender'].'</td>
									<td>'.$row['verified'].'</td>
									<td>
										<a href="#" id="'.$row['id'].'" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUsersDetails"><i class="fas fa-info-circle fa-lg"></i></a>
										<a href="#" id="'.$row['id'].'" title="Delete User" class="text-danger deleteUserIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
										<a href="#" id="'.$row['id'].'" title="Send Message" class="text-primary sendMessageIcon" data-toggle="modal" data-target="#sendMessageModal"><i class="fas fa-comments fa-lg"></i></a>
										<a href="#" id="'.$row['id'].'" title="Verify User" class="text-primary verifyUserIcon"><i class="fas fa-check fa-lg"></i></a>
										
									</td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any User Registered</h3>';
		}
	}

	// Handle View User Details
	if(isset($_POST['details_id'])){
		$id = $_POST['details_id'];

		$data = $admin->fetchUserDetailsByID($id);

		echo json_encode($data);
	}
	// Handle View Record Details
	if(isset($_POST['view_records'])){
		$id = $_POST['view_records'];

		$data = $admin->fetchUserRecordsByID($id);

		echo json_encode($data);
	}

	// Handle View Events Details
	if(isset($_POST['view_event'])){
		$id = $_POST['view_event'];

		$data = $admin->fetchUserEvents($id);

		echo json_encode($data);
	}

	// Delete User
	if(isset($_POST['del_id'])){
		$id = $_POST['del_id'];
		$admin->userAction($id, 0);
	}

	// Verify User
	if(isset($_POST['verify_id'])){
		$id = $_POST['verify_id'];
		$admin->verifyUser($id, 1);
	}

	// View User Incident Ajax Request
	if(isset($_POST['incident_id'])){
		$id = $_POST['incident_id'];
		$table = "incident_reports";
		$row = $admin->view_records($id, $table);
		echo json_encode($row);
	}

	// Edit Incident Records Ajax Request
	if(isset($_POST['edit_id'])){
		$id = $_POST['edit_id'];

		$row = $admin->edit_incident($id);
		echo json_encode($row);
	}

	// Update Incident record Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'update_incident'){
		$inc_id 		= $admin->test_input($_POST['inc_id']);
		$DTReported 	= $admin->test_input($_POST['DTReported']);
		$DTIncident 	= $admin->test_input($_POST['DTIncident']);
		$personsInv 	= $admin->test_input($_POST['personsInv']);
		$witnessInv 	= $admin->test_input($_POST['witnessInv']);
		$description 	= $admin->test_input($_POST['description']);
		$reportedBy 	= $admin->test_input($_POST['reportedBy']);
		$notedBy 		= $admin->test_input($_POST['incident_noted']);
		$actionMade		= $admin->test_input($_POST['action_made']);
		print("BOBO");
		print($notedBy);
		$row = $admin->edit_incident_reports($inc_id, $DTReported, $DTIncident, $personsInv, $witnessInv, $description, $reportedBy, $notedBy, $actionMade);
		$admin->notification($inc_id,  'admin','Incident Report Updated');
		
	}

	// View User Consultation Ajax Request
	if(isset($_POST['consult_id'])){
		$id = $_POST['consult_id'];
		$table = "consultation_reports";
		$row = $admin->view_records($id, $table);
		echo json_encode($row);
	}
	// View User Acceptance Ajax Request
	if(isset($_POST['accept_id'])){
		$id = $_POST['accept_id'];
		$table = "acceptance_reports";
		$row = $admin->view_records($id, $table);
		echo json_encode($row);
	}

	// Delete User Record Ajax Request
	if(isset($_POST['inc_del'])){
		$id = $_POST['inc_del'];
		$table = incident_reports;

		$row = $admin->recordAction($table, $id, 0);
		$admin->notification($cid, 'admin', 'Record Deleted');
		echo json_encode($row);
	}

	// Delete User Record Ajax Request
	if(isset($_POST['cons_del'])){
		$id = $_POST['cons_del'];
		$table = consultation_reports;

		$row = $admin->recordAction($table, $id, 0);
		$admin->notification($cid, 'admin', 'Record Deleted');
		echo json_encode($row);
	}

	// Delete User Record Ajax Request
	if(isset($_POST['accept_del'])){
		$id = $_POST['accept_del'];
		$table = acceptance_reports;

		$row = $admin->recordAction($table, $id, 0);
		$admin->notification($cid, 'admin', 'Record Deleted');
		echo json_encode($row);
	}

	

	// Fetch All deleted Users
	if(isset($_POST['action']) && $_POST['action'] == 'fetchDeletedUsers'){
		$output = '';
		$data = $admin->fetchAllUsers(1);
		$path = '../assets/php/';

		if($data){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						
						<th>User ID</th>
						<th>Name</th>
						<th>E-Mail</th>
						<th>Phone</th>
						<th>Gender</th>
						<th>Verified</th>
						<th>Action</th>
						</tr>
						</thead>
						<tbody>';
				foreach ($data as $row) {
					if($row['photo'] != ''){
						$uphoto = $path.$row['photo'];
					}
					else{
						$uphoto = '../assets/img/avatar.png.';
					}

					if($row['verified'] == 1){
						$row['verified'] = 'Verified';
					}else{
						$row['verified'] = 'Not Verified';
					}
					$output .= '<tr>
									
									<td>'.$row['id'].'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['phone'].'</td>
									<td>'.$row['gender'].'</td>
									<td>'.$row['verified'].'</td>
									<td>
										
										<a href="#" id="'.$row['id'].'" title="Recover User" class="text-white restoreUserIcon badge badge-dark p-2">Restore</a>
										<a href="#" id="'.$row['id'].'" title="Delete User" class="text-white removeUserIcon badge badge-danger p-2">Remove</a>
									</td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any User Deleted</h3>';
		}
	}

	// Fetch All deleted Incident Records
	if(isset($_POST['action']) && $_POST['action'] == 'IncidentDeletedRecords'){
		$output = '';
		$record = $admin->userIncidentRecords(1);
		

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center" id="table5">
				<thead>
					<tr>
						<th data-visible="false">Record ID</th>
						<th>Username</th>
						<th>User E-Mail</th>
						<th>Title</th>
						<th>Description</th>
						<th>Reported By</th>
						<th>Noted By</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>';
				foreach ($record as $row) {
					
					$output .= '<tr>
									<td>'.$row['id'].'</td>	
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>						
									<td>'.$row['title']. ' - ' .$row['reported_by'].'</td>
									<td>'.$row['incident_description'].'</td> 
									<td>'.$row['reported_by'].'</td> 
									<td>'.$row['noted_by'].'</td>
									<td>
										
									<a href="#" id="'.$row['id'].'" title="Recover Record" class="text-white restoreIncidentIcon badge badge-dark p-2">Restore</a>
									<a href="#" id="'.$row['id'].'" title="Delete Record" class="text-white removeIncidentIcon badge badge-danger p-2">Remove</a>
										
									</td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any Deleted Record</h3>';
		}
	}
	// DELETED CONSULTATION
	if(isset($_POST['action']) && $_POST['action'] == 'ConsultDeletedRecords'){
		$output = '';

		$record = $admin->userConsultationRecords(1);

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center" id="table2" style="width:100%">
 					<thead>
 						<tr>
						 	<th data-visible="false">Record ID</th>
							<th>Username</th>
							<th>User E-Mail</th>
 							<th>Title</th>
 							<th>Name of Client </th>
							<th>Purpose</th>
							<th>Recorded By</th>
							<th>Actions</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($record as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>							
							<td>'.$row['name'].'</td>
							<td>'.$row['email'].'</td>
 							<td>'.$row['title']. ' - ' .$row['name_client'].'</td>
 							<td>'.$row['name_client'].'</td>
 							<td>'.substr($row['purpose'],0, 10).'...</td>
							<td>'.$row['recorded_by'].'</td>
							
 							<td>
							 <a href="#" id="'.$row['id'].'" title="Recover Record" class="text-white restoreConsulttIcon badge badge-dark p-2">Restore</a>
							 <a href="#" id="'.$row['id'].'" title="Delete Record" class="text-white removeConsultIcon badge badge-danger p-2">Remove</a>
 							</td>
 						</tr>';
 		}
 		$output .='</tbody></table>';
 		echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary"> You have no Records </h3>';
		}
	}

	// DELETED Acceptance Records
	if(isset($_POST['action']) && $_POST['action'] == 'AcceptDeletedRecords'){
		$output = '';

		$record = $admin->userAcceptanceRecords(1);

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center" id="table7" style="width:100%">
 					<thead>
 						<tr>
 							<th data-visible="false">Record ID</th>
							<th>Username</th>
							<th>User E-Mail</th>
 							<th>Title</th>
							<th>Date</th> 
 							<th>Student Name</th>
 							<th>Student Violation </th>
 							
							<th>Actions</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($record as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>	
							<td>'.$row['name'].'</td>
							<td>'.$row['email'].'</td>						
 							<td>'.$row['title']. ' - ' .$row['name_student'].'</td>
 							<td>'.$row['date_reported'].'</td>
 							<td>'.$row['name_student'].'</td>
							<td>'.$row['student_violation'].'</td>
 							<td>
							 <a href="#" id="'.$row['id'].'" title="Recover Record" class="text-white restoreAcceptIcon badge badge-dark p-2">Restore</a>
							 <a href="#" id="'.$row['id'].'" title="Delete Record" class="text-white removeAcceptIcon badge badge-danger p-2">Remove</a>
 							</td>
 						</tr>';
 		}
 		$output .='</tbody></table>';
 		echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary"> You have no Records </h3>';
		}
	}

	// handle Restore User
	if(isset($_POST['res_id'])){
		$id = $_POST['res_id'];

		$admin->userAction($id, 1);
	}
	// Delete User
	if(isset($_POST['rem_id'])){
		$id = $_POST['rem_id'];

		$admin->userDelete($id, 0);
	}

	// All Incident Records
	if(isset($_POST['action']) && $_POST['action'] == 'fetchIncident'){
		$output = '';
		$record = $admin->userIncidentRecords(0);
		
		
		if($record){
			$output .= '<table class="table table-striped table-bordered text-center" id="table" style="width:100%">
 					<thead>
 						<tr>
 							<th data-visible="true">Record ID</th>
							<th>Username</th>
							<th>User E-Mail</th>
 							<th>Title</th>
 							<th>Persons Involved</th>
 							<th>Witness Involved</th>
 							<th>Incident Description</th>
							<th>Reported By</th>
							<th>Action Taken</th>
							
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($record as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>	
							<td>'.$row['name'].'</td>
							<td>'.$row['email'].'</td>						
 							<td>'.$row['title']. ' - ' .$row['reported_by'].'</td>
							<td>'.$row['persons_involved'].'</td>
							<td>'.$row['witness_involved'].'</td>
 							<td>'.substr($row['incident_description'],0, 10).'...</td>
							<td>'.$row['reported_by'].'</td> 
							
 							<td>
 								<a href="#" id="'.$row['id'].'" title="View Details" class="text-success IncinfoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#ViewRecordModal"></i>&nbsp;</a>
 								<a href="#" id="'.$row['id'].'" title="Edit Record" class="text-primary InceditBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editRecordModal2"></i></a>&nbsp;
								<a href="#" id="'.$row['id'].'" title="Archive Incident" class="text-danger IncdeleteBtn"><i class="fas fa-folder-open fa-lg"></i></a>
 							</td>
 						</tr>';
 		}
 		$output .='</tbody></table>';
 		echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary"> You have no Records </h3>';
		}
	}


	// Display Consultation Records
	if(isset($_POST['action']) && $_POST['action'] == 'fetchConsultation'){
		$output = '';

		$record = $admin->userConsultationRecords(0);

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center" id="table2" style="width:100%">
 					<thead>
 						<tr>
 							<th data-visible="false">Record ID</th>
 							<th>Title</th>
 							<th>Type of Client</th>
 							<th>Name of Client </th>
 							<th>Name of Organization</th>
							<th>Date of Consultation</th>
							<th>Purpose</th>
							<th>Action Taken</th>
							<th>Recorded By</th>
							<th>Actions</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($record as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>							
 							<td>'.$row['title']. ' - ' .$row['name_client'].'</td>
 							<td>'.$row['client'].'</td>
 							<td>'.$row['name_client'].'</td>
							<td>'.$row['name_org'].'</td>
							<td>'.$row['date_consultation'].'</td>
 							<td>'.substr($row['purpose'],0, 10).'...</td>
							 <td>'.substr($row['action_taken'],0, 10).'...</td>
							<td>'.$row['recorded_by'].'</td>
							
 							<td>
 								<a href="#" id="'.$row['id'].'" title="View Details" class="text-success ConsinfoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#viewConsultModal"></i>&nbsp;</a>
 								<a href="#" id="'.$row['id'].'" title="Archive Consultation" class="text-danger ConsdeleteBtn"><i class="fas fa-folder-open fa-lg"></i></a>
 							</td>
 						</tr>';
 		}
 		$output .='</tbody></table>';
 		echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary"> You have no Records </h3>';
		}
	}

	// Display Acceptance Records
	if(isset($_POST['action']) && $_POST['action'] == 'fetchAcceptance'){
		$output = '';

		$record = $admin->userAcceptanceRecords(0);

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center" id="table3" style="width:100%">
 					<thead>
 						<tr>
 							<th data-visible="false">Record ID</th>
 							<th>Title</th>
							<th>Date</th> 
 							<th>Student Name</th>
 							<th>Student Violation </th>
 							<th>Allow Class</th>
 							<th>Allow Phone</th>
							<th>Actions</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($record as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>							
 							<td>'.$row['title']. ' - ' .$row['name_student'].'</td>
 							<td>'.$row['date_reported'].'</td>
 							<td>'.$row['name_student'].'</td>
							<td>'.$row['student_violation'].'</td>
							<td>'.$row['allow_class'].'</td>
							<td>'.$row['allow_phone'].'</td>
 							<td>
 								<a href="#" id="'.$row['id'].'" title="View Details" class="text-success AccinfoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#viewAcceptanceModal"></i>&nbsp;</a>
 								<a href="#" id="'.$row['id'].'" title="Archive Acceptance" class="text-danger AccdeleteBtn"><i class="fas fa-folder-open fa-lg"></i></a>
 							</td>
 						</tr>';
 		}
 		$output .='</tbody></table>';
 		echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary"> You have no Records </h3>';
		}
	}

	if(isset($_POST['action']) && $_POST['action'] == 'add_referral'){
		$type 			= $admin->test_input($_POST['rectype']);
		$title 			= $type;
		$FirstName 		= $admin->test_input($_POST['first_name']);
		$LastName  		= $admin->test_input($_POST['last_name']);
		$course  		= $admin->test_input($_POST['refCourse']);
		$year  			= $admin->test_input($_POST['refYear']);
		$reason  		= $admin->test_input($_POST['refReason']);
		$description 	= $admin->test_input($_POST['incident_desc']);

		// $notedBy = $cname;
		$admin->add_new_referral($title, $FirstName, $LastName, $course, $year, $reason, $description);
		// $admin->notification($cid,  'admin', 'New Record Added');
	}
	// Display Referral Records
	if(isset($_POST['action']) && $_POST['action'] == 'fetchReferral'){
		$output = '';

		$record = $admin->referralRecords(0);

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center mt-2" id="table4" style="width:100%">
 					<thead>
 						<tr>
 							<th data-visible="false">Record ID</th>
 							<th>Title</th>
							<th>Date</th> 
 							<th>Student Name</th>
							<th>Student Course & Year</th>
 							<th>Reason for Referral</th>
 							<th>Incident Description</th>
							<th>Actions</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($record as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>							
 							<td>'.$row['title']. ' - ' .$row['student_fName'].'</td>
 							<td>'.$row['created_at'].'</td>
 							<td>'.$row['student_fName']. ' ' .$row['student_lName'].'</td>
							<td>'.$row['course'].' ' .$row['ryear'].'</td>
							<td>'.$row['reason'].'</td>
							<td>'.$row['incident_description'].'</td>
 							<td>
 								<a href="#" id="'.$row['id'].'" title="View Details" class="text-success AccinfoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#viewAcceptanceModal"></i>&nbsp;</a>
 								<a href="#" id="'.$row['id'].'" title="Archive Acceptance" class="text-danger AccdeleteBtn"><i class="fas fa-folder-open fa-lg"></i></a>
 							</td>
 						</tr>';
 		}
 		$output .='</tbody></table>';
 		echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary"> You have no Records </h3>';
		}
	}
	// Fetch Latest Incident Records
	if(isset($_POST['action']) && $_POST['action'] == 'LatestIncidentRecords'){
		$output = '';
		$record = $admin->LatestIncidentRecords(0);
		

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						<th>User ID</th>
						<th>User E-mail</th>
						<th>Record Title</th>
		
				</tr>
			</thead>
						<tbody>';
				foreach ($record as $row) {
					
					$output .= '<tr>
									<td>'.$row['uid'].'</td>
									<td>'.substr($row['email'],0,10).'</td>
									<td>'.$row['title'].' - '.$row['reported_by'].' </td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any Record</h3>';
		}
	}

	// Fetch Latest Consultation Records
	if(isset($_POST['action']) && $_POST['action'] == 'LatestConsultRecords'){
		$output = '';
		$record = $admin->LatestConsultRecords(0);
		

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						<th>User ID</th>
						<th>User E-mail</th>
						<th>Record Title</th>
		
				</tr>
			</thead>
						<tbody>';
				foreach ($record as $row) {
					
					$output .= '<tr>
									<td>'.$row['uid'].'</td>
									<td>'.substr($row['email'],0,10).'</td>
									<td>'.$row['title'].' - '.$row['name_client'].' </td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any Record</h3>';
		}
	}

	// Fetch Latest Acceptance Records
	if(isset($_POST['action']) && $_POST['action'] == 'LatestAcceptRecords'){
		$output = '';
		$record = $admin->LatestAcceptRecords(0);
		

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						<th>User ID</th>
						<th>User E-mail</th>
						<th>Record Title</th>
		
				</tr>
			</thead>
						<tbody>';
				foreach ($record as $row) {
					
					$output .= '<tr>
									<td>'.$row['uid'].'</td>
									<td>'.substr($row['email'],0,10).'</td>
									<td>'.$row['title'].' - '.$row['name_student'].' </td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any Record</h3>';
		}
	}

	// Fetch Latest Users
	if(isset($_POST['action']) && $_POST['action'] == 'fetchAllLatestUsers'){
		$output = '';
		$record = $admin->fetchAllLatestUsers(0);
		

		if($record){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						
						<th>ID</th>
						<th>User Email</th>
						<th>User Status</th>
		
				</tr>
			</thead>
						<tbody>';
				foreach ($record as $row) {
					if($row['verified'] == 1){
						$row['verified'] = 'Verified';
					}else{
						$row['verified'] = 'Not Verified';
					}
					$output .= '<tr>
									<td>'.$row['id'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['verified'].'</td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any Record</h3>';
		}
	}

	//Fetch Record Types
	if(isset($_POST['action']) && $_POST['action'] == 'fetchRecordTypes'){
		$output = '';
		$types = $admin->fetchRecordTypes();
		

		if($types){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						
						<th>ID</th>
						<th>Record Types</th>
						<th>Action</th>	
		
				</tr>
			</thead>
						<tbody>';
				foreach ($types as $row){
					
					$output .= '<tr>
									<td>'.$row['id'].'</td>
									<td>'.$row['record_type'].'</td>
									<td>
									<a href="#" id="'.$row['id'].'" title="Delete Record Type" class="text-danger deleteTypeIcon"><i class="fas fa-box-archive fa-lg"></i></a>
									</td>
									
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any Record Types</h3>';
		}
	}

	//Delete Record of Admin
	if(isset($_POST['rec_id'])){
		$id = $_POST['rec_id'];

		$admin->recordAction($id, 0);
	}
	// Add Event Ajax
	if(isset($_POST['action']) && $_POST['action'] == 'event'){
		$subject = $admin->test_input($_POST['subject']);
		$event = $admin->test_input($_POST['event']);
		$when_at = $admin->test_input($_POST['when_at']);

		$admin->add_event($subject, $event, $when_at);
		print($_POST['subject']);
		print($_POST['event']);
		print($_POST['when_at']);
		// $admin->notification($cid, 'admin', 'New Event Added');
	}
	
	// Delete Event
	if(isset($_POST['event_id'])){
		$id = $_POST['event_id'];

		$admin->deleteEvent($id, 0);
	}

	// Revert Incident Record of Admin
	if(isset($_POST['Inc_rev_id'])){
		$id = $_POST['Inc_rev_id'];
		$table = incident_reports;
		$admin->recordAction($table, $id, 1);
	}

	// Revert Consultation Record of Admin
	if(isset($_POST['cons_rev_id'])){
		$id = $_POST['cons_rev_id'];
		$table = consultation_reports;
		$admin->recordAction($table, $id, 1);
	}

	// Revert Acceptance Record of Admin
	if(isset($_POST['accept_rev_id'])){
		$id = $_POST['accept_rev_id'];
		$table = acceptance_reports;
		$admin->recordAction($table, $id, 1);
	}

	// Permanent Incident Delete Record
	if(isset($_POST['perm_inc_id'])){
		$id = $_POST['perm_inc_id'];
		$table = incident_reports;
		$admin->recordDelete($table,$id, 0);
	}

	// Permanent Consultation Delete Record
	if(isset($_POST['perm_cons_id'])){
		$id = $_POST['perm_cons_id'];
		$table = consultation_reports;
		$admin->recordDelete($table,$id, 0);
	}

	// Permanent Acceptance Delete Record
	if(isset($_POST['perm_accept_id'])){
		$id = $_POST['perm_accept_id'];
		$table = acceptance_reports;
		$admin->recordDelete($table,$id, 0);
	}

	//Fetch Events
	if(isset($_POST['action']) && $_POST['action'] == 'fetchAllEvents'){
		$output = '';
		$events = $admin->fetchEvents();
		

		if($events){
			$output .= '<table class="table table-striped table-bordered text-center">
			<thead>
				<tr>
						<th>Event</th>
						<th>When</th>
						<th>Subject</th>
						<th>Created At</th>
						<th>Action On</th>
						</tr>
						</thead>
						<tbody>';
				foreach ($events as $row) {
					
					$output .= '<tr>
									<td>'.$row['event'].'</td>
									<td>'.$row['date'].'</td>
									<td>'.$row['subject'].'</td>
									<td>'.$row['created_at'].'</td>
									<td>
										<a href="#" id="'.$row['id'].'" title="View Event Details" class="text-primary eventDetailsIcon" data-toggle="modal" data-target="#showEventDetails"><i class="fas fa-info-circle fa-lg"></i></a>
										<a href="#" id="'.$row['id'].'" title="Delete Event" class="text-danger deleteEventIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
																				
									</td>
								</tr>';
				}
				$output .= '</tbody>
							</table>';
				echo $output;		
		}
		else{
			echo '<h3 class="text-center text-secondary">No Any Events</h3>';
		}
	}

	

	// Reply Event to user
	if(isset($_POST['message'])){
		$uid = $_POST['uid'];
		$message = $admin->test_input($_POST['message']);
		$fid = $_POST['fid'];

		$admin->replyEvent($uid, $message);
		$admin->eventReplied($fid);
	}

	// Send Message to user
	if(isset($_POST['action']) && $_POST['action'] == 'sendMessage'){
		$message2 = $admin->test_input($_POST['message']);

		$admin->sendMessage($uid,$message2);
	}

	// Fetch Notification
	if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
		$notification = $admin->fetchNotification();
		$output = '';

		if($notification){
			foreach ($notification as $row){
				$output .= '<div class="alert alert-warning" role="alert">
								<button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
									<h4 class="alert-heading">Activity Logs</h4>
									<p class="mb-0 lead">'.$row['message'].' By: '.$row['name'].'</p>
									<hr class="my-2">
									<p class="mb-0 float-left"><b>User Email:</b>'.$row['email'].'<b>&nbsp;&nbsp;&nbsp;User ID:  </b>'.$row['uid'].'</p>
									<p class="mb-0 float-right">'.$admin->timeInAgo($row['created_at']).'</p>
									<div class="clearfix"></div>
							</div>';
			}
			echo $output;

		}
		else{
			echo '<h3 class="text-center text-secondary mt-5">No New Notification</h3>';
		}
	}

	//Check Notification
	if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
		if($admin->fetchNotification()){
			echo '<i class="fas fa-circle text-danger fa-xs"></i>';
		}
		else{
			echo '';
		}
	}

	//Remove Notification
	if(isset($_POST['notification_id'])){
		$id = $_POST['notification_id'];
		$admin->removeNotification($id);
	}

	//Export All Users in Excel
	if(isset($_GET['export']) && $_GET['export'] == 'excel'){
		header("Content-Type: application/xls");
		header("Content-Disposition: attachment; filename=users.xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		$data = $admin->exportAllUsers();
		echo '<table border="1" align=center>';

		echo '<tr>
				<th>#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Gender</th>
				<th>DOB</th>
				<th>Joined On</th>
				<th>Verified</th>
				<th>Deleted</th>
				</tr>';
		foreach ($data as $row) {
			echo '<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['gender'].'</td>
					<td>'.$row['dob'].'</td>
					<td>'.$row['created_at'].'</td>
					<td>'.$row['verified'].'</td>
					<td>'.$row['deleted'].'</td>
					</tr>';
		}
		echo '</table>';
		
	}

	// Filter Months
	if(isset($_POST['action']) && $_POST['action'] == 'filter_records'){
		$month = $admin->test_input($_POST['month']);
		
		// $row = $admin->filter_records($month);
		echo json_encode($month);
		
	}

	//Export MONTHLY RECORDS
	if(isset($_GET['export']) && $_GET['export'] == 'monthlyRecords'){
		$month = $_GET['month'];
		$data = $admin->filter_records($month);
		
		// if($month == 1){
		// 	$month == 'January';
		// }
		// if($month == 2){
		// 	$month == 'February';
		// }
		// if($month == 3){
		// 	$month == 'March';
		// }
		

		
		header("Content-Type: application/vnd.msword");
		header("Content-Disposition: attachment; filename=Monthly_Records.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		
			echo '<!DOCTYPE html>
			<html>
		
			
			<head>
			
			
		
			<div class="row">
				<div class="column">
					<img src="https://imgur.com/OSws8fs.png" alt="CVSU LOGO" width="630" height="150"</img>
				</div>
			</div>
			
			
		
			</head>
			<body>
				
				<h1>TOTAL RECORDS FOR THIS MONTH: '.$data.'</h1>
			
		
			
			</body>
			</html>';
				
		
		

		
	
}
	if(isset($_POST['action']) && $_POST['action'] == 'changeoptions') {
		$output = '<option value="" disabled selected>Select date</option>';
		switch($_POST['value']) {
			case "monthly":
				for($i = 1; $i <= 12; $i++) { 
					$output .= '<option value="' . $i . '">' . getMonthName($i) . '</option>';
				}
				break;
			case "semestral":
				$data = $admin->GetSemesters($_POST['report']);
				foreach($data as $acadYear => $value) {
					//$output .= $value;
					for($i = 0; $i < count($data[$acadYear]); $i++) {
						$year = $acadYear + 1;
						$output .= '<option value="' . $data[$acadYear][$i] . '-' . $acadYear . '">' . $data[$acadYear][$i] . ' (' . $acadYear . ' - ' . $year . ')</option>';
					}
				}
				break;
			case "annual":
				$pivotYear = 1900;
				$yearNow = date('Y');
				for($i = $yearNow; $i >= $pivotYear; $i--) {
					$output .= '<option value="' . $i . '">' . $i . '</option>';
				}
				break;
		}
		echo json_encode(array('data' => $output));
	}

	function getMonthName($monthNum) {
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F');
		return $monthName;
	}
 ?>