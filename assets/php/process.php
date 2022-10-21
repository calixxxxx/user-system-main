<?php 
require_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';

	$mail = new PHPMailer(true);

	// Add New Incident Ajax
	if(isset($_POST['action']) && $_POST['action'] == 'add_incident'){
		$type = $cuser->test_input($_POST['rectype']);
		$title = $type;
		$DTReported = $cuser->test_input($_POST['DTReported']);
		$DTIncident = $cuser->test_input($_POST['DTIncident']);
		$personsInv = $cuser->test_input($_POST['personsInv']);
		$witnessInv = $cuser->test_input($_POST['witnessInv']);
		$description = $cuser->test_input($_POST['description']);
		$reportedBy = $cuser->test_input($_POST['reportedBy']);
		$notedBy = $cname;
		$studentNum = $cuser->test_input($_POST['studentNum']);
		$cuser->add_new_incident($cid, $title, $DTReported, $DTIncident, $personsInv, $witnessInv, $description, $reportedBy, $notedBy, $studentNum);
		$cuser->add_record_count($title);
		$cuser->notification($cid,  'admin', 'New Record Added');
	}

	// Add New Consultation Ajax
	if(isset($_POST['action']) && $_POST['action'] == 'add_consultation'){
		$type = $cuser->test_input($_POST['rectype']);
		$title = $type;
		$client = $cuser->test_input($_POST['box1']);
		$DTConsult = $cuser->test_input($_POST['date-of-consult']);
		$clientID = $cuser->test_input($_POST['client-id']);
		$ClientName = $cuser->test_input($_POST['client-name']);
		$ClientOrg = $cuser->test_input($_POST['client-org']);
		$TimeStarted = $cuser->test_input($_POST['time-started']);
		$TimeEnded = $cuser->test_input($_POST['time-ended']);
		$Purpose = $cuser->test_input($_POST['purpose']);
		$ActionTaken = $cuser->test_input($_POST['action-taken']);
		$RecordedBy = $cname;

		$cuser->add_new_consultation($cid, $title, $client, $DTConsult, $clientID, $ClientName, $ClientOrg, $TimeStarted, $TimeEnded, $Purpose, $ActionTaken, $RecordedBy);
		$cuser->add_record_count($title);
		$cuser->notification($cid,  'admin', 'New Consultation Added');
	}

	// Add New Acceptance
	if(isset($_POST['action']) && $_POST['action'] == 'add_acceptance'){
		$type = $cuser->test_input($_POST['rectype']);
		$title = $type;
		$DTreport = $cuser->test_input($_POST['date-reported']);
		$StudentName = $cuser->test_input($_POST['student-name']);
		$violation = $cuser->test_input($_POST['box2']);
		$AllowClass = $cuser->test_input($_POST['allow-class']);
		$AllowPhone = $cuser->test_input($_POST['allow-phone']);
		$studentNum = $cuser->test_input($_POST['studentNum']);
		$recordedBy = $cname;
		$cuser->add_new_acceptance($cid, $title, $DTreport, $StudentName, $violation, $AllowClass, $AllowPhone, $studentNum, $recordedBy);
		$cuser->add_record_count($title);
		$cuser->notification($cid,  'admin', 'New Acceptance Added');
	}

	// Display Records
	// if(isset($_POST['action']) && $_POST['action'] == 'display_records'){
	// 	$output = '';

	// 	$records = $cuser->get_records($cid);

	// 	if($records){
	// 		$output .= '<table class="table table-striped table-bordered text-center ">
 	// 				<thead>
 	// 					<tr>
 	// 						<th data-visible="false">User ID</th>
 	// 						<th>Title</th>
 	// 						<th>Record Type</th>
 	// 						<th>Student Name</th>
 	// 						<th>Record Description</th>
 	// 						<th>Date Created</th>
 	// 						<th>Action</th>
 	// 					</tr>
 	// 				</thead>
 	// 				<tbody>';
 	// 	foreach($records as $row){
 	// 		$output .= '<tr>
 	// 						<td>'.$row['id'].'</td>							
 	// 						<td>'.$row['title'].'</td>
 	// 						<td>'.$row['type'].'</td>
 	// 						<td>'.$row['student_name'].'</td>
 	// 						<td>'.substr($row['record'],0, 10).'...</td>
 	// 						<td>'.$row['created_at'].'</td>
 	// 						<td>
 	// 							<a href="#" id="'.$row['id'].'" title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#ViewRecordModal"></i>&nbsp;</a>
 	// 							<a href="#" id="'.$row['id'].'" title="Edit Record" class="text-primary editBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editRecordModal"></i></a>&nbsp;
 	// 							<a href="#" id="'.$row['id'].'" title="Delete Record" class="text-danger deleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
 	// 						</td>
 	// 					</tr>';
 	// 	}
 	// 	$output .='</tbody></table>';
 	// 	echo $output;
	// 	}
	// 	else{
	// 		echo '<h3 class="text-center text-secondary"> You have no Records </h3>';
	// 	}
	// }

	// Display Incident Records
	if(isset($_POST['action']) && $_POST['action'] == 'display_incidents'){
		$output = '';

		$records = $cuser->get_incident_records($cid);

		if($records){
			$output .= '<table class="table table-striped table-bordered text-center" id="table" style="width:100%">
 					<thead>
 						<tr>
 							<th data-visible="false">Record ID</th>
 							<th>Title</th>
 							<th>Time Reported</th>
 							<th>Time of Incident </th>
 							<th>Persons Involved</th>
 							<th>Witness Involved</th>
 							<th>Incident Description</th>
							<th>Reported By</th>
							<th>Noted By</th>
							<th>Actions</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($records as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>							
 							<td>'.$row['title']. ' - ' .$row['reported_by'].'</td>
 							<td>'.$row['time_reported'].'</td>
 							<td>'.$row['time_incident'].'</td>
							<td>'.$row['persons_involved'].'</td>
							<td>'.$row['witness_involved'].'</td>
 							<td>'.substr($row['incident_description'],0, 10).'...</td>
							<td>'.$row['reported_by'].'</td> 
							<td>'.$row['noted_by'].'</td>
 							<td>
 								<a href="#" id="'.$row['id'].'" title="View Details" class="text-success IncinfoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#ViewRecordModal"></i>&nbsp;</a>
 								<a href="#" id="'.$row['id'].'" title="Edit Record" class="text-primary InceditBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editRecordModal"></i></a>&nbsp;
 								<a href="#" id="'.$row['id'].'" title="Delete Incident" class="text-danger IncdeleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
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
	if(isset($_POST['action']) && $_POST['action'] == 'display_consultation'){
		$output = '';

		$records = $cuser->get_consultation_records($cid);

		if($records){
			$output .= '<table class="table table-striped table-bordered text-center" id="table2" style="width:100%">
 					<thead>
 						<tr>
 							<th data-visible="false">Record ID</th>
 							<th>Title</th>
 							<th>Type of Client</th>
 							<th>Name of Client </th>
 							<th>Name of Organization</th>
 							<th>Time Started</th>
 							<th>Time Ended</th>
							<th>Date of Consultation</th>
							<th>Purpose</th>
							<th>Action Taken</th>
							<th>Recorded By</th>
							<th>Actions</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($records as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td>							
 							<td>'.$row['title']. ' - ' .$row['name_client'].'</td>
 							<td>'.$row['client'].'</td>
 							<td>'.$row['name_client'].'</td>
							<td>'.$row['name_org'].'</td>
							<td>'.$row['time_started'].'</td>
							<td>'.$row['time_ended'].'</td>
							<td>'.$row['date_consultation'].'</td>
 							<td>'.substr($row['purpose'],0, 10).'...</td>
							 <td>'.substr($row['action_taken'],0, 10).'...</td>
							<td>'.$row['recorded_by'].'</td>
							
 							<td>
 								<a href="#" id="'.$row['id'].'" title="View Details" class="text-success ConsinfoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" data-target="#viewConsultModal"></i>&nbsp;</a>
 								<a href="#" id="'.$row['id'].'" title="Edit Record" class="text-primary ConseditBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editConsultModal"></i></a>&nbsp;
 								<a href="#" id="'.$row['id'].'" title="Delete Record" class="text-danger ConsdeleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
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
	if(isset($_POST['action']) && $_POST['action'] == 'display_acceptance'){
		$output = '';

		$records = $cuser->get_acceptance_records($cid);

		if($records){
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
 		foreach($records as $row){
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
 								<a href="#" id="'.$row['id'].'" title="Edit Record" class="text-primary AcceditBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#EditAcceptanceModal"></i></a>&nbsp;
 								<a href="#" id="'.$row['id'].'" title="Delete Record" class="text-danger AccedeleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
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

	//Record Types
	if(isset($_POST['action']) && $_POST['action'] == 'fetchRecordType'){
		$output = '';
		$record_type = $cuser->record_type();

		if($record_type){
			$output .= '<option value="" disabled selected>Select Record Type</option>';

			foreach($record_type as $row){
				$output .= '<option>'.$row['record_type'].'</option>';
			
			}
	echo $output;
	}else{
		echo '<h3>No Record Types</h3>';
		}
	}



	// Edit Incident Records Ajax Request
	if(isset($_POST['edit_id'])){
		$id = $_POST['edit_id'];

		$row = $cuser->edit_incident($id);
		echo json_encode($row);
	}

	// Edit Consult Records Ajax Request
	if(isset($_POST['edit_consult'])){
		$id = $_POST['edit_consult'];

		$row = $cuser->edit_consult($id);
		echo json_encode($row);
	}

	// Edit Event Ajax Request
	if(isset($_POST['edit_event'])){
		$id = $_POST['edit_event'];

		$row = $cuser->edit_event($id);
		echo json_encode($row);
	}

	// Update Incident record Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'update_incident'){
		$inc_id 		= $cuser->test_input($_POST['inc_id']);
		$DTReported 	= $cuser->test_input($_POST['DTReported']);
		$DTIncident 	= $cuser->test_input($_POST['DTIncident']);
		$personsInv 	= $cuser->test_input($_POST['personsInv']);
		$witnessInv 	= $cuser->test_input($_POST['witnessInv']);
		$description 	= $cuser->test_input($_POST['description']);
		$reportedBy 	= $cuser->test_input($_POST['reportedBy']);
		$notedBy 		= $cuser->test_input($_POST['notedBy']);
		
		$cuser->edit_incident_reports($inc_id, $DTReported, $DTIncident, $personsInv, $witnessInv, $description, $reportedBy, $notedBy);
		$cuser->notification($cid,  'admin','Incident Report Updated');
	}

	// Update Consultation Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'update_consultation'){
		$cons_id 	= $cuser->test_input($_POST['cons_id']);
		$client 	= $cuser->test_input($_POST['box3']);
		$DTConsult 	= $cuser->test_input($_POST['date-of-consult3']);
		$nClient 	= $cuser->test_input($_POST['client-name3']);
		$nOrg 		= $cuser->test_input($_POST['client-org3']);
		$tStarted 	= $cuser->test_input($_POST['time-started3']);
		$tEnded 	= $cuser->test_input($_POST['time-ended3']);
		$Purpose 	= $cuser->test_input($_POST['purpose3']);
		$aTaken 	= $cuser->test_input($_POST['action-taken3']);
		$recordedBy = $cuser->test_input($_POST['recordedBy3']);
		
		$cuser->edit_consultation_reports($cons_id, $client, $DTConsult, $nClient, $nOrg, $tStarted, $tEnded, $Purpose, $aTaken, $recordedBy);
		$cuser->notification($cid, 'admin', $cons_id);
		
	}

	// Update Acceptance Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'update_acceptance'){
		$acc_id 			= $cuser->test_input($_POST['acc_id']);
		$date_reported 		= $cuser->test_input($_POST['date-reported']);
		$name_student 		= $cuser->test_input($_POST['student-name']);
		$student_violation 	= $cuser->test_input($_POST['box']);
		$allow_class 		= $cuser->test_input($_POST['allow-class']);
		$allow_phone 		= $cuser->test_input($_POST['allow-phone']);
		$cuser->edit_acceptance_reports($acc_id, $date_reported, $name_student, $student_violation, $allow_class, $allow_phone);
		$cuser->notification($cid,  'admin', 'Acceptance Slip Updated');
		
	}
	

	// Update Event Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'update_event'){
		$id = $cuser->test_input($_POST['id']);
		$event = $cuser->test_input($_POST['event']);
		$when_at = $cuser->test_input($_POST['when_at']);
		$subject = $cuser->test_input($_POST['subject']);
		

		$cuser->update_event($id,$event, $when_at, $subject);
		$cuser->notification($cid, 'admin', 'Event Updated');
	}


	// Delete User Record Ajax Request
	if(isset($_POST['inc_del'])){
		$id = $_POST['inc_del'];

		$cuser->delete_incident($id, 0);
		$cuser->notification($cid, 'admin', 'Record Deleted');
	}
	// Delete Consult Record Ajax Request
	if(isset($_POST['cons_del'])){
		$id = $_POST['cons_del'];

		$cuser->delete_consult($id, 0);
		$cuser->notification($cid, 'admin', 'Record Deleted');
	}
	if(isset($_POST['acce_del'])){
		$id = $_POST['acce_del'];

		$cuser->delete_acceptance($id, 0);
		$cuser->notification($cid, 'admin', 'Record Deleted');
	}
	// Delete User Event
	if(isset($_POST['edel_id'])){
		$id = $_POST['edel_id'];

		$cuser->delete_event($id);
		$cuser->notification($cid, 'admin', 'Event Deleted');
	}

	// View User Record Ajax Request
	if(isset($_POST['info_id'])){
		$id = $_POST['info_id'];

		$row = $cuser->edit_record($id);

		echo json_encode($row);
	}
	// View User Record Ajax Request
	if(isset($_POST['incident_id'])){
		$id = $_POST['incident_id'];

		$row = $cuser->edit_incident($id);
		echo json_encode($row);
	}
	// View Consult Ajax Request
	if(isset($_POST['consult_id'])){
		$id = $_POST['consult_id'];

		$row = $cuser->edit_consult($id);
		echo json_encode($row);
	}
	// View Acceptance Ajax Request
	if(isset($_POST['accept_id'])){
		$id = $_POST['accept_id'];

		$row = $cuser->edit_accept($id);
		echo json_encode($row);
	}

	// View User Event
	if(isset($_POST['event_id'])){
		$id = $_POST['event_id'];

		$row = $cuser->edit_event($id);

		echo json_encode($row);
	}

	// Profile Update Ajax Request
	if(isset($_FILES['image'])){
		$name = $cuser->test_input($_POST['name']);
		$gender = $cuser->test_input($_POST['gender']);
		$dob = $cuser->test_input($_POST['dob']);
		$phone = $cuser->test_input($_POST['phone']);

		$oldImage = $_POST['oldimage'];
		$folder = 'uploads/';

		if(isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")){
			
			$newImage = $folder.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $newImage);

			if($oldImage != null){
				unlink($oldImage);
			}
		}
		else{
			$newImage = $oldImage;
		}
		$cuser->update_profile($name, $gender, $dob, $phone, $newImage, $cid);
		$cuser->notification($cid, 'admin', 'Profile Updated');
	}

	// Change Pass Ajax
	if(isset($_POST['action']) && $_POST['action'] == 'change_pass'){
		$currentPass = $_POST['currpass'];
		$newPass = $_POST['newpass'];
		$cnewPass = $_POST['cnewpass'];

		$hnewPass = password_hash($newPass, PASSWORD_DEFAULT);

		if($newPass != $cnewPass){
			echo $cuser->showMessage('danger','Password did not matched!');
		}
		else{
			if(password_verify($currentPass, $cpass)){
				$cuser->change_password($hnewPass, $cid);
				echo $cuser->showMessage('success','Password Successfully Changed');
				$cuser->notification($cid, 'admin', 'Password Changed');
			}
			else{
				echo $cuser->showMessage('danger', 'Current Password is Incorrect!');
			}
		}
	}

	// Handle Verify E-mail
	if(isset($_POST['action']) && $_POST['action'] == 'verify_email'){
			try{
				$mail->isSMTP();
				$mail->Host = 'smtp.mailtrap.io';
				$mail->SMTPAuth = true;
				$mail->Username = '9a5417329f9f93';
				$mail->Password = '1cdf4a384c3642';
				$mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 2525;

				$mail->setFrom(Database::USERNAME, 'CALIX');
				$mail->addAddress($cemail);

				$mail->isHTML(true);
				$mail->Subject = 'Email Verification';
				$mail->Body = '<h3>Click the link below to Verify your E-Mail. <br>
				<a href="http://localhost/user-system/verify-email.php?email='.$cemail.'">http://localhost/user-system/verify-email.php?email='.$cemail.'</a><br>Regards<br>CEIT Guidance!</h3>';

				$mail->send();
				echo $cuser->showMessage('success', 'We have send you the verification link to your email');
			}
			catch(Exception $e){
				echo $cuser->showMessage('danger', 'Something went wrong, Please Try Again Later');
			}
	}

	// Handle Event Ajax
	if(isset($_POST['action']) && $_POST['action'] == 'event'){
		$subject = $cuser->test_input($_POST['subject']);
		$event = $cuser->test_input($_POST['event']);
		$when_at = $cuser->test_input($_POST['when_at']);

		$cuser->send_event($subject, $event, $when_at, $cid);
		$cuser->notification($cid, 'admin', 'New Event Added');
	}


	
	

	// Handle Fetch Notif
	if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
		$notification = $cuser->fetchNotification($cid);
		$output = '';

		if($notification){
			foreach ($notification as $row){
				$output .= '<div class="alert alert-danger" role="alert">
								<button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="close">
								<span aria-hidden="true">&times;</span>
								</button>
									<h5 class="alert-heading">New Notification</h5>
									<div class="justify-content-between d-flex">
									<p class="mb-0 lead d-flex">'.$row['message'].'</p>
									<a href="#" id="'.$row['id'].'" title="Send Message" class="text-primary sendMessageIcon" data-toggle="modal" data-target="#MessageAdminModal"><i class="fas fa-reply fa-lg mt-3"></i></a>
									</div>
									<hr class="my-2">
									<p class="mb-0 float-left">Message from Admin</p>
									<p class="mb-0 float-right">'.$cuser->timeInAgo($row['created_at']).'</p>
									<div class="clearfix"></div>
							</div>';
			}
			echo $output;

		}
		else{
			echo '<h3 class="text-center text-dark mt-5">No New Notification</h3>';
		}
	}

	// Send Message to Admin
	if(isset($_POST['message'])){
		
		print($_POST['message']);
		$message = $cuser->test_input($_POST['message']);

		$cuser->notification($cid, 'admin', $message.'  Message ');
	}

	// Fetch Notification
	if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
		if($cuser->fetchNotification($cid)){
			echo '<i class="fas fa-circle fa-xs text-danger" style="font-size: 0.5rem; vertical-align: top;"></i>';
		}
		else{
			echo '';
		}
	}

	//Remove Notif
	if(isset($_POST['notification_id'])){
		$id = $_POST['notification_id'];
		$cuser->removeNotification($id);
	}

	// Display Events
	if(isset($_POST['action']) && $_POST['action'] == 'display_events'){
		$output = '';

		$events = $cuser->get_events();

		if($events){
			$output .= '<table class="table table-striped text-center">
 					<thead>
 						<tr>
 							<th># ID</th>
 							<th>Event Name</th>
 							<th>Description</th>
 							<th>Event Date</th>
 							<th>Date Created</th>
 							<th>Action</th>
 						</tr>
 					</thead>
 					<tbody>';
 		foreach($events as $row){
 			$output .= '<tr>
 							<td>'.$row['id'].'</td> 							
 							<td>'.$row['event'].'</td>
 							<td>'.substr($row['subject'],0, 15).'...</td>
 							<td>'.$row['date'].'</td>
 							<td>'.$row['created_at'].'</td>
 							
 							<td>
 								<a href="#" id="'.$row['id'].'" title="View Details" class="text-success EveinfoBtn"><i class="fas fa-info-circle fa-lg" data-toggle="modal" ></i>&nbsp;</a>
 								<a href="#" id="'.$row['id'].'" title="Delete Event" class="text-danger deleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
 							</td>
 						</tr>';
 		}
 		$output .='</tbody></table>';
 		echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary"> You have no Events </h3>';
		}
	}
 ?>