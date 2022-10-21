<?php 
require_once 'config.php';

class Admin extends Database{

	//Admin Login

	public function admin_login($username, $password){
		$sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['username'=>$username, 'password'=>$password]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row;
	}

	//Dashboard Users Count
	public function total_count($tablename){
		$sql = "SELECT * FROM $tablename";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->rowCount();

		return $count;

	}

	// Count Total Verified/Unverified Users
	public function verified_users($status){
		$sql = "SELECT * FROM users WHERE verified = :status";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['status'=>$status]);
		$count = $stmt->rowCount();

		return $count;
	}

	// Gender %
	public function gender_percent(){
		$sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Users Verified %
	public function users_percent(){
		$sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}

	// site visitors
	public function site_visitors(){
		$sql = "SELECT hits FROM visitors";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
		return $count;
	}

	// Fetch All Registered Data
	public function fetchAllUsers($val){
		$sql = "SELECT * FROM users WHERE deleted != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Fetch All Registered Data
	public function fetchAllLatestUsers($val){
		$sql = "SELECT * FROM users WHERE deleted != $val ORDER BY id desc LIMIT 5";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Fetch Users Details
	public function fetchUserDetailsByID($id){
		$sql = "SELECT * FROM users WHERE id = :id AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	// View Incident Record of User
	public function view_records($id, $table){
		$sql = "SELECT * FROM $table WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	// Deleted Records deletedIncidentRecords
	public function deletedIncidentRecords($val){
		$sql= "SELECT incident_reports.id, incident_reports.title, incident_reports.incident_description, incident_reports.time_reported, incident_reports.time_incident, incident_reports.persons_involved, incident_reports.witness_involved, incident_reports.reported_by, incident_reports.noted_by, incident_reports.created_at, incident_reports.updated_at, users.name, users.email FROM incident_reports INNER JOIN users ON incident_reports.uid = users.id WHERE incident_reports.deleted != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	// View Events
	public function fetchUserEvents($id){
		$sql = "SELECT * FROM all_events WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	//Delete Event
	public function deleteEvent($id){
		$sql = "DELETE FROM all_events WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	}

	//Delete User
	public function userAction($id, $val){
		$sql = "UPDATE users SET deleted = $val WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	}

	//Verify User
	public function verifyUser($id, $val){
		$sql = "UPDATE users SET verified = $val WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	}
	// Permanent Delete User
	public function userDelete($id, $val){
		$sql = "DELETE FROM users WHERE id = :id AND deleted = 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	}


	//Show All Records
	public function userIncidentRecords($val){
		$sql= "SELECT incident_reports.id, incident_reports.title, incident_reports.incident_description, incident_reports.time_reported, incident_reports.time_incident, incident_reports.persons_involved, incident_reports.witness_involved, incident_reports.reported_by, incident_reports.noted_by, incident_reports.created_at, incident_reports.updated_at, users.name, users.email FROM incident_reports INNER JOIN users ON incident_reports.uid = users.id WHERE incident_reports.deleted != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	public function userConsultationRecords($val){
		$sql= "SELECT consultation_reports.id, consultation_reports.title, consultation_reports.client, consultation_reports.name_client, consultation_reports.name_org, consultation_reports.time_started, consultation_reports.time_ended, consultation_reports.date_consultation, consultation_reports.purpose, consultation_reports.action_taken, consultation_reports.recorded_by, consultation_reports.updated_at, consultation_reports.created_at, users.name, users.email FROM consultation_reports INNER JOIN users ON consultation_reports.uid = users.id WHERE consultation_reports.deleted != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	public function userAcceptanceRecords($val){
		$sql= "SELECT acceptance_reports.id, acceptance_reports.title, acceptance_reports.date_reported, acceptance_reports.name_student, acceptance_reports.allow_class, acceptance_reports.allow_phone, acceptance_reports.student_violation,  acceptance_reports.created_at, acceptance_reports.updated_at, users.name, users.email FROM acceptance_reports INNER JOIN users ON acceptance_reports.uid = users.id WHERE acceptance_reports.deleted != $val";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function referralRecords($val){
		$sql= "SELECT * FROM referral_reports";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	//Show Latest Incident Records
	public function LatestIncidentRecords($val){
		$sql= "SELECT incident_reports.id, incident_reports.title, incident_reports.reported_by, incident_reports.uid, users.name, users.email FROM incident_reports INNER JOIN users ON incident_reports.uid = users.id WHERE incident_reports.deleted != $val ORDER BY id desc LIMIT 5";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	//Show Latest Consult Records
	public function LatestConsultRecords($val){
		$sql= "SELECT consultation_reports.id, consultation_reports.title, consultation_reports.name_client, consultation_reports.uid, users.name, users.email FROM consultation_reports INNER JOIN users ON consultation_reports.uid = users.id WHERE consultation_reports.deleted != $val ORDER BY id desc LIMIT 5";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	//Show Latest Acceptance Records
	public function LatestAcceptRecords($val){
		$sql= "SELECT acceptance_reports.id, acceptance_reports.title, acceptance_reports.name_student, acceptance_reports.uid, users.name, users.email FROM acceptance_reports INNER JOIN users ON acceptance_reports.uid = users.id WHERE acceptance_reports.deleted != $val ORDER BY id desc LIMIT 5";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	//Delete Record
	public function recordAction($table, $id, $val){
		$sql = "UPDATE $table SET deleted = $val WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	}

	// View Record Types
	public function fetchRecordTypes(){
		$sql = "SELECT * FROM record_types";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Add Record Type
	public function add_new_type($type){
		$sql = "INSERT INTO record_types (record_type) VALUES (:type)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['type'=>$type]);

		
		return true;
	}

	//Delete Record type
	public function del_new_type($id){
		$sql = "DELETE FROM record_types WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	}

	//Events
	public function fetchEvents(){
		$sql = "SELECT * FROM all_events";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	// Add Event 
	public function add_event($sub, $event, $when_at){
		$sql = "INSERT INTO all_events (subject, event, date) VALUES (:sub, :event, :date)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['sub'=>$sub, 'event'=>$event, 'date'=>$when_at]);
		return true;

	}

	// Permanent Delete Record
	public function recordDelete($table, $id, $val){
		$sql = "DELETE FROM $table WHERE id = :id AND deleted = 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		return true;
	}


	//Reply Events
	public function replyEvent($uid, $message){
		$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, 'user', :message)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid, 'message'=>$message]);
		return true;
	}

	public function sendMessage($uid, $message){
		$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, 'user', :message)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid, 'message'=>$message]);
		return true;
	}
	
	//Set Feedback Replied
	public function eventReplied($fid){
		$sql = "UPDATE events SET replied = 1 WHERE id = :fid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['fid'=>$fid]);
		return true;
	}
	
	//Notification

	public function fetchNotification(){
		$sql = "SELECT notification.id, notification.uid, notification.message, notification.created_at, users.name, users.email FROM notification INNER JOIN users ON notification.uid = users.id WHERE type = 'admin' ORDER BY notification.id DESC";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	//Remove Notification
	public function removeNotification($id){
		$sql = "DELETE FROM notification WHERE id= :id and type = 'admin'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);
		return true;
	}

	//export all users
	public function exportAllUsers(){
		$sql = "SELECT * FROM users";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	// EXPORT RECORD
	public function exportRecord($table, $id){
		$sql = "SELECT * FROM $table WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	// FILTER MONTHS
	public function filter_records($month){
		$sql = "SELECT * FROM record_counts  WHERE MONTH(created_at) = $month";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->rowCount();
		
		return $count;

	}
	// GENERATE SEMESTERS
	public function GetSemesters($reportType = NULL) {
		if(is_null($reportType)) {
			return;
		}
		$table = NULL;
		switch($reportType) {
			case 'incidentReport':
				$table = "incident_reports";
				break;
			case 'consultationReport':
				$table = "consultation_reports";
				break;
			case 'acceptanceSlip':
				$table = "acceptance_reports";
				break;
		}
		// 1st 9 - 1
		// 2nd 2 - 6
		// Summer 7 - 8
		$sql = "SELECT MONTH(`created_at`) `MONTH`, YEAR(`created_at`) `YEAR` FROM `" . $table . "` WHERE `created_at` IS NOT NULL AND `deleted` != 0 GROUP BY MONTH(`created_at`), YEAR(`created_at`) ORDER BY YEAR(`created_at`) DESC, MONTH(`created_at`) DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data = array();
		if(count($results) > 0) {
			$year = NULL;
			foreach ($results as $result) {
				$month = $result['MONTH'];
				$year = $result['YEAR'];
				if($month == 1 || ($month <= 12 && $month >= 9)) {
					if($month == 1) {
						$year--;
					}
					if(!array_key_exists($year, $data)) {
						$data[$year] = array();
					}
					if(!in_array("1st Semester", $data[$year])) {
						$data[$year][] = "1st Semester";
					}
				} else if($month == 7 || $month == 8) {
					if(!array_key_exists($year, $data)) {
						$data[$year] = array();
					}
					if(!in_array("Summer", $data[$year])) {
						$data[$year][] = "Summer";
					}
				} else {
					$year--;
					if(!array_key_exists($year, $data)) {
						$data[$year] = array();
					}
					if(!in_array("2nd Semester", $data[$year])) {
						$data[$year][] = "2nd Semester";
					}
				}
			}
		}
		return $data;
	}
}
?>