<?php 
require_once 'admin-db.php';
$admin = new Admin();
session_start();

// Export incident Records
	if(isset($_GET['export']) && $_GET['export'] == 'doc'){
		$id = $_GET['id'];
		$table = incident_reports;
		$data = $admin->exportRecord($table, $id);
		header("Content-Type: application/vnd.msword");
		header("Content-Disposition: attachment; filename=Incident_Record.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		
		foreach ($data as $row) {
		echo '<!DOCTYPE html>
		<html>
		<head>
		<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<div class="row">
			<div class="column" style="text-align: center">
				<img src="https://i.imgur.com/HRa5Yxk.png" alt="CVSU LOGO" width="450" height="170"</img>
			</div>
		</div>

		</head>
		<body>
			<h1>'.$row['title']. ' - ' .$row['reported_by'].'</h1>
			<div>
				<div style="text-align:right;font-size: 120%">
					<div>
					<label><b>Date Reported: </b> '.$row['time_reported'].'</label></div>
					<label><b>Date Incident: </b> '.$row['time_incident'].'</label>
				</div>
				
			</div>
			<div>
				<div style="text-align:left;font-size: 120%">
					<div>
					<label><b>Persons Involved:</b> '.$row['persons_involved'].'</label></div>
					<label><b>Witness Involved:</b> '.$row['witness_involved'].'</label>
				</div>
			</div>
			<br>
			<div>
				<div style="text-align:left;font-size: 120%">
					<label><b>Brief Description of the Incident:</b></label></div>

					<p style="font-size: 110%">'.$row['incident_description'].'</p>
				</div>
			</div>
			<div>
				<div style="text-align:left; font-size: 120%">
					<div><label><b>Reported By:</b> '.$row['reported_by'].'</label></div>
					<label><b>Noted By:</b> '.$row['noted_by'].'</label>
				</div>
			</div>
		</body>
		</html>';
		}	
	}
// Export Consultation Records
	if(isset($_GET['export']) && $_GET['export'] == 'doc2'){
		$id = $_GET['id'];
		$table = consultation_reports;
		$data = $admin->exportRecord($table, $id);
		header("Content-Type: application/vnd.msword");
		header("Content-Disposition: attachment; filename=Consultation_Record.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		
		foreach ($data as $row) {
		echo '<!DOCTYPE html>
		<html>
		<head>
		<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<div class="row">
			<div class="column">
				<img src="https://imgur.com/OSws8fs.png" alt="CVSU LOGO" width="630" height="150"</img>
			</div>
		</div>
		</head>
		<body>
			
		<h1>'.$row['title']. ' - ' .$row['name_client'].'</h1>
		<div>
			<div style="text-align:right;font-size: 120%">
				<div>
				<label><b>Name of Client: </b> '.$row['name_client'].'</label></div>
				<label><b>Client: </b> '.$row['client'].'</label>
			</div>
			
		</div>
		<div>
			<div style="text-align:left;font-size: 120%">
				<div>
				<label><b>Name of Org/Inst:</b> '.$row['name_org'].'</label></div>
				<label><b>Date of Consultation:</b> '.$row['date_consultation'].'</label>
			</div>
		</div>
		<br>
		<div>
			<div style="text-align:left;font-size: 120%">
				<label><b>Purpose of Consultation:</b></label></div>

				<p style="font-size: 110%">'.$row['purpose'].'</p>
			</div>
		</div>
		<div>
			<div style="text-align:left; font-size: 120%">
				<div><label><b>Action Taken:</b> '.$row['action_taken'].'</label></div>
				<label><b>Recorded By:</b> '.$row['recorded_by'].'</label>
			</div>
		</div>

		<div>
			<div style="text-align:left; font-size: 120%">
				<div><label><b>Time Started:</b> '.$row['time_started'].'</label></div>
				<label><b>Time Ended:</b> '.$row['time_ended'].'</label>
			</div>
		</div>

		
		</body>
		</html>';
		}	
	}
// Export Acceptance Records
if(isset($_GET['export']) && $_GET['export'] == 'doc3'){
	$id = $_GET['id'];
	$table = acceptance_reports;
	$data = $admin->exportRecord($table, $id);
	header("Content-Type: application/vnd.msword");
	header("Content-Disposition: attachment; filename=Acceptance_record.doc");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	
	foreach ($data as $row) {
	echo '<!DOCTYPE html>
	<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<div class="row">
		<div class="column">
			<img src="https://imgur.com/OSws8fs.png" alt="CVSU LOGO" width="630" height="150"</img>
		</div>
	</div>

	</head>
	<body>
		
	<h1>'.$row['title']. ' - ' .$row['name_student'].'</h1>
	<div>
		<div style="text-align:right;font-size: 120%">
			<div>
			<label><b>Date Reported: </b> '.$row['date_reported'].'</label></div>
			<label><b>Name of Student: </b> '.$row['name_student'].'</label>
		</div>
		
	</div>
	
	<br>
	<div>
		<div style="text-align:left;font-size: 120%">
			<label><b>Student Violation:</b></label></div>

			<p style="font-size: 110%">'.$row['student_violation'].'</p>
		</div>
	</div>
	<div>
		<div style="text-align:left; font-size: 100%">
			<div><label><b>Please admit the student to your class today:</b> '.$row['allow_class'].'</label></div>
			<label><b>Please allow the student to get his/her phone back:</b> '.$row['allow_phone'].'</label>
		</div>
	</div>
	
	</body>
	</html>';
	}	
}

	


 ?>