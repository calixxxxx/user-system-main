<?php

	require_once 'config.php';

	class Auth extends Database{

		//Register New user
		public function register($name, $email, $student_number, $password){
			$sql = "INSERT INTO users (name, email, student_number, password) VALUES (:name, :email, :student_number, :pass)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['name'=>$name, 'email'=>$email, 'student_number'=>$student_number, 'pass'=>$password]);
			return true;
		}
		// Check if Registered already
		public function user_exist($email){
			$sql = "SELECT email FROM users WHERE email = :email";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}
		public function name_exist($name){
			$sql = "SELECT name FROM users WHERE name = :name";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['name'=>$name]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}
		public function id_exist($student_number){
			$sql = "SELECT student_number FROM users WHERE student_number = :student_number";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['student_number'=>$student_number]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;
		}



		//Check if Login User Exist
		public function login($email){
			$sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			

			return $row;
		}
		// Current Users in Session
		public function currentUser($email){
			$sql = "SELECT * FROM users WHERE email = :email AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}

		
		// Forgot Password
		public function forgot_password($token, $email){
			$sql = "UPDATE users SET token = :token, token_expired = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['token'=>$token,'email'=>$email]);

			return true;
		}

		//Reset Password
		public function reset_pass_auth($email, $token){
			$sql = "SELECT id FROM users WHERE email = :email AND token = :token AND TOKEN != '' AND token_expired > NOW() AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email, 'token'=>$token]);

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;

		}

		//Update Password
		public function update_new_pass($pass, $email){
			$sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['pass'=>$pass, 'email'=>$email]);
			return true;
		}

		// Add New Record
		public function add_new_record($uid, $title, $type, $student_name, $record){
			$sql = "INSERT INTO records (uid, title, type, student_name, record) VALUES (:uid, :title, :type, :student_name, :record)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'title'=>$title, 'type'=>$type, 'student_name'=>$student_name, 'record'=>$record]);

			
			return true;
		}

		// Add New Incident
		public function add_new_incident($uid, $title, $DTReported, $DTIncident, $personsInv, $witnessInv, $description, $reportedBy, $notedBy, $studentNum){
			$sql = "INSERT INTO incident_reports (uid, title, student_num, time_reported, time_incident, persons_involved, witness_involved, incident_description, reported_by, noted_by) 
			VALUES (:uid, :title, :student_num, :time_reported, :time_incident, :persons_involved, :witness_involved, :incident_description, :reported_by, :noted_by)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'title'=>$title, 'student_num'=>$studentNum, 'time_reported'=>$DTReported, 'time_incident'=>$DTIncident, 'persons_involved'=>$personsInv, 'witness_involved'=>$witnessInv,'incident_description'=>$description, 'reported_by'=>$reportedBy, 'noted_by'=>$notedBy]);

			
			return true;
		}

		// Add New Consultation
		public function add_new_consultation($uid, $title, $client, $DTConsult, $clientID, $ClientName, $ClientOrg, $TimeStarted, $TimeEnded, $Purpose, $ActionTaken, $RecordedBy){
			$sql = "INSERT INTO consultation_reports (uid, title, student_num, client, name_client, name_org, time_started, time_ended, date_consultation, purpose, action_taken, recorded_by) 
			VALUES (:uid, :title, :client_id, :client, :name_client, :name_org, :time_started, :time_ended, :date_consultation, :purpose, :action_taken, :recorded_by)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'title'=>$title, 'client_id'=>$clientID, 'client'=>$client, 'name_client'=>$ClientName, 'name_org'=>$ClientOrg, 'time_started'=>$TimeStarted,'time_ended'=>$TimeEnded, 'date_consultation'=>$DTConsult, 'purpose'=>$Purpose, 'action_taken'=>$ActionTaken, 'recorded_by'=>$RecordedBy ]);

			
			return true;
		}

		// Add New Acceptance
		public function add_new_acceptance($uid, $title, $DTreport, $StudentName, $violation, $AllowClass, $AllowPhone, $studentNum, $recordedBy){
			$sql = "INSERT INTO acceptance_reports (uid, title, student_num, date_reported, name_student, student_violation, allow_class, allow_phone, recorded_by) 
			VALUES (:uid, :title, :student_num, :date_reported, :name_student, :student_violation, :allow_class, :allow_phone, :recorded_by )";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'title'=>$title, 'student_num'=>$studentNum, 'date_reported'=>$DTreport, 'name_student'=>$StudentName, 'student_violation'=>$violation, 'allow_class'=>$AllowClass, 'allow_phone'=>$AllowPhone, 'recorded_by'=>$recordedBy ]);

			
			return true;
		}

		// Select Record Types
		public function record_type(){
			$sql ="SELECT * FROM record_types";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		// Fetch Records of User
		public function get_records($uid){
			$sql = "SELECT * FROM records WHERE uid = :uid AND deleted = 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid]);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		// Fetch Incident Records of User
		public function get_incident_records($uid){
			$sql = "SELECT * FROM incident_reports WHERE uid = :uid AND deleted = 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid]);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		public function get_consultation_records($uid){
			$sql = "SELECT * FROM consultation_reports WHERE uid = :uid AND deleted = 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid]);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function get_acceptance_records($uid){
			$sql = "SELECT * FROM acceptance_reports WHERE uid = :uid AND deleted = 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid]);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		// Get All Events
		public function get_events(){
			$sql = "SELECT * FROM all_events";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		// Edit Incident Record of User
		public function edit_incident($id){
			$sql = "SELECT * FROM incident_reports WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		// Edit Consultation Record of User
		public function edit_consult($id){
			$sql = "SELECT * FROM consultation_reports WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		public function edit_accept($id){
			$sql = "SELECT * FROM acceptance_reports WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		// Edit Event of User
		public function edit_event($id){
			$sql = "SELECT * FROM all_events WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		// Update Incident Record User
		
		// public function incident_reports ($id, $DTReported, $DTIncident, $personsInv, $witnessInv, $description, $reportedBy, $notedBy){
		// 	$sql 	= "UPDATE incident_reports SET time_reported = :DTReported, time_incident = :DTIncident, persons_involved = :personsInv, witness_involved = :witnessInv, incident_description = :description, reported_by = :reportedBy, noted_by = :notedBy, updated_at = NOW() WHERE id = :id";
		// 	$stmt	= $this->conn->prepare($sql);
		// 	$stmt->execute(['id'=>$id, 'DTReported'=>$DTReported, 'DTIncident'=>$DTIncident, 'personsInv'=>$personsInv, 'witnessInv'=>$witnessInv, 'description'=>$description, 'reportedBy'=>$reportedBy, 'notedBy'=>$notedBy]);
		// 	return true;
		// }
		public function edit_incident_reports($id, $DTReported, $DTIncident, $personsInv, $witnessInv, $description, $reportedBy, $notedBy){
			$sql = "UPDATE incident_reports SET time_reported = :time_reported, time_incident = :time_incident, persons_involved = :persons_involved, witness_involved = :witness_involved, incident_description = :incident_description, reported_by = :reported_by, updated_at = NOW() WHERE id = :id AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id, 'time_reported'=>$DTReported, 'time_incident'=>$DTIncident, 'persons_involved'=>$personsInv, 'witness_involved'=>$witnessInv, 'incident_description'=>$description, 'reported_by'=>$reportedBy]);
			return true;
		}
		// Update Consultation Record User
		public function edit_consultation_reports($id, $client, $DTConsult, $nClient, $nOrg, $tStarted, $tEnded, $purpose, $aTaken, $recordedBy){
			$sql = "UPDATE consultation_reports SET client = :client, date_consultation = :DTConsult, name_client = :nClient, name_org = :nOrg, time_started = :tStarted, time_ended = :tEnded, purpose = :purpose, action_taken = :aTaken, recorded_by = :recordedBy,  updated_at = NOW() WHERE id = :id AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id, 'client'=>$client, 'DTConsult'=>$DTConsult, 'nClient'=>$nClient, 'nOrg'=>$nOrg, 'tStarted'=>$tStarted, 'tEnded'=>$tEnded, 'purpose'=>$purpose, 'aTaken'=>$aTaken, 'recordedBy'=>$recordedBy]);
			return true;
		}
		// Update Acceptance Record User
		public function edit_acceptance_reports($id, $date_reported, $name_student, $student_violation, $allow_class, $allow_phone){
			$sql = "UPDATE acceptance_reports SET date_reported = :date_reported, name_student = :name_student, student_violation = :student_violation, allow_class = :allow_class, allow_phone = :allow_phone, updated_at = NOW() WHERE id = :id AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id, 'date_reported'=>$date_reported, 'name_student'=>$name_student, 'student_violation'=>$student_violation, 'allow_class'=>$allow_class, 'allow_phone'=>$allow_phone]);
			return true;
		}

		// Update Event of User
		public function update_event($id,$event, $when_at, $subject){
			$sql = "UPDATE events SET event = :event, when_at = :when_at, subject = :subject WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['event'=>$event, 'when_at'=>$when_at, 'subject'=>$subject, 'id'=>$id]);
			return true;
		}

		// Delete Record

		public function delete_incident($id, $val){
			$sql = "UPDATE incident_reports SET deleted = $val WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}
		public function delete_consult($id, $val){
			$sql = "UPDATE consultation_reports SET deleted = $val WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}
		public function delete_acceptance($id, $val){
			$sql = "UPDATE acceptance_reports SET deleted = $val WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}
		// Delete Event
		public function delete_event($id){
			$sql = "DELETE FROM events WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}

		//Update Profile of User
		public function update_profile($name, $gender, $dob, $phone, $photo, $id){
			$sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo WHERE id = :id AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['name'=>$name, 'gender'=>$gender, 'dob'=>$dob, 'phone'=>$phone, 'photo'=>$photo, 'id'=>$id]);
			return true;
		}

		// Change Password of User

		public function change_password($pass, $id){
			$sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['pass'=>$pass, 'id'=>$id]);
			return true;
		}

		// Verify Email
		public function verify_email($email){
			$sql = "UPDATE users SET verified = 1 WHERE email = :email AND deleted != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			return true;
		}

		// // Send Event 
		// public function send_event($sub, $event, $when_at, $uid){
		// 	$sql = "INSERT INTO events (uid, subject, event, when_at) VALUES (:uid, :sub, :event, :when_at)";
		// 	$stmt = $this->conn->prepare($sql);
		// 	$stmt->execute(['uid'=>$uid, 'sub'=>$sub, 'event'=>$event, 'when_at'=>$when_at]);
		// 	return true;

		// }
		
		

		// Insert Notification

		public function notification($uid, $type, $message){
			$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'type'=>$type, 'message'=>$message]);
			return true;
		}

		// Fetch Notif from user

		public function fetchNotification($uid){
			$sql = "SELECT * FROM notification WHERE uid = :uid and type = 'user' ORDER BY id DESC";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid]);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		// Delete Notification
		public function removeNotification($id){
		$sql = "DELETE FROM notification WHERE id = :id AND type = 'user'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);
		return true;
		}

		public function add_record_count($title){
		$sql = "INSERT INTO record_counts (title) VALUES (:title)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['title'=>$title]);
		return true;
		}

		
}

?>
