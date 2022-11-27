<?php
	require_once 'libraries/TCPDF/tcpdf.php';
	session_start();

	$response = array();
	$reports = array("incidentReport", "consultationReport", "acceptanceSlip", "referralSlip");
	$report = NULL;

	// Validate POST data
	if(!isset($_GET['report']) || empty($_GET['report'])) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Parameter";
		$response['message'] = "Report parameter not set or empty";
		echo json_encode($response);
		exit();
	}

	$keyword = "";
	// Assign keyword
	if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
	}

	// Sanitize and assign data to variables
	// $data = json_decode($_POST['data']);
	$report = $_GET['report'];

	// Validate data
	if(!in_array($report, $reports)) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Report";
		$response['message'] = "Can't generate report";
		echo json_encode($response);
		exit();
	}
	// if(count($data) <= 0) {
	// 	$response['status'] = 'warning';
	// 	$response['title'] = "No data";
	// 	$response['message'] = "Nothing to export";
	// 	return FALSE;
	// }
	$sentence = "mysql:host=localhost;dbname=db_user_system";
	$username = "root";
	$password = "";
	$connection = NULL;

	try {
		$connection = new PDO($sentence, $username, $password);
	} catch(PDOExeption $e) {
		throw new Exception($e->getMessage(), 1);
		exit();
	}

	$date = date('Y') . '-' . date('m') . '-' . date('d');

	switch($report) {
		case "incidentReport":
			$statement = "SELECT `ir`.`id`, `ir`.`title`, `ir`.`incident_description`, `ir`.`time_reported`, `ir`.`time_incident`, `ir`.`persons_involved`, `ir`.`witness_involved`, `ir`.`reported_by`, `ir`.`noted_by`, `ir`.`created_at`, `ir`.`updated_at`, `u`.`name`, `u`.`email` FROM `incident_reports` `ir` INNER JOIN `users` `u` ON `ir`.`uid` = `u`.`id` WHERE `ir`.`deleted` != :in_active AND (`ir`.`title` LIKE '%" . $keyword . "%' OR `ir`.`incident_description` LIKE '%" . $keyword . "%' OR `ir`.`persons_involved` LIKE '%" . $keyword . "%' OR `ir`.`witness_involved` LIKE '%" . $keyword . "%' OR `ir`.`reported_by` LIKE '%" . $keyword . "%' OR `ir`.`noted_by` LIKE '%" . $keyword . "%' OR `u`.`name` LIKE '%" . $keyword . "%' OR `u`.`email` LIKE '%" . $keyword . "%' OR `u` .`id` LIKE '%" . $keyword . "%')";
			$parameters = array('in_active' => 0);
			break;
		case "consultationReport":
			$statement = "SELECT `cr`.`id`, `cr`.`title`, `cr`.`client`, `cr`.`name_client`, `cr`.`name_org`, `cr`.`time_started`, `cr`.`time_ended`, `cr`.`date_consultation`, `cr`.`purpose`, `cr`.`action_taken`, `cr`.`recorded_by`, `cr`.`updated_at`, `cr`.`created_at`, `u`.`name`, `u`.`email` FROM `consultation_reports` `cr`INNER JOIN `users` `u` ON `cr`.`uid` = `u`.`id` WHERE `cr`.`deleted` != :in_active AND (`cr`.`title` LIKE '%" . $keyword . "%' OR `cr`.`client` LIKE '%" . $keyword . "%' OR `cr`.`name_client` LIKE '%" . $keyword . "%' OR `cr`.`name_org` LIKE '%" . $keyword . "%' OR `cr`.`date_consultation` LIKE '%" . $keyword . "%' OR `cr`.`purpose` LIKE '%" . $keyword . "%' OR `cr`.`action_taken` LIKE '%" . $keyword . "%' OR `cr`.`recorded_by` LIKE '%" . $keyword . "%' OR `u`.`name` LIKE '%" . $keyword . "%' OR `u`.`email` LIKE '%" . $keyword . "%')";
			$parameters = array('in_active' => 0);
			break;
		case "acceptanceSlip":
			$statement = "SELECT `ar`.`id`, `ar`.`title`, `ar`.`date_reported`, `ar`.`name_student`, `ar`.`allow_class`, `ar`.`allow_phone`, `ar`.`student_violation`, `ar`.`created_at`, `ar`.`updated_at`, `u`.`name`, `u`.`email` FROM `acceptance_reports` `ar` INNER JOIN `users` `u` ON `ar`.`uid` = `u`.`id` WHERE `ar`.`deleted` != :in_active AND (`ar`.`title` LIKE '%" . $keyword . "%' OR `ar`.`date_reported` LIKE '%" . $keyword . "%' OR `ar`.`name_student` LIKE '%" . $keyword . "%' OR `ar`.`student_violation` LIKE '%" . $keyword . "%')";
			$parameters = array('in_active' => 0);
			break;
		case "referralSlip":
			$statement = "SELECT `ar`.`id`, `ar`.`title`, `ar`.`student_fName`, `ar`.`student_lName`, `ar`.`course`, `ar`.`ryear`, `ar`.`reason`, `ar`.`incident_description`, `ar`.`created_at`, `ar`.`updated_at`, `u`.`name`, `u`.`email` FROM `referral_reports` `ar` WHERE `ar`.`deleted` != :in_active AND (`ar`.`title` LIKE '%" . $keyword . "%' OR `ar`.`created_at` LIKE '%" . $keyword . "%' OR `ar`.`student_fName` LIKE '%" . $keyword . "%' OR `ar`.`reason` LIKE '%" . $keyword . "%')";
			$parameters = array('in_active' => 0);
			break;
	}

	$rows = array();

	try {
        $stmt = $connection->prepare($statement);
        $stmt->execute($parameters);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e) {
        throw new Exception($e->getMessage());   
    }

    if(count($rows) <= 0) {
		$response['status'] = 'warning';
		$response['title'] = "No data";
		$response['message'] = "Nothing to export";
		echo json_encode($response);
		return;
    }

    // echo '<pre>';
    // print_r($rows);
    // echo '</pre>';
    // exit();

	class PdfTemplate extends TCPDF {
    	//Page header
	    public function Header() {
	        // Logo
	        $this->Image('storage/images/CvSU-logo2.png', 90, 8, 20, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        // Title
	        $this->Ln(1);
	        $CenturyGothic = TCPDF_FONTS::addTTFfont('libraries/TCPDF/custom-fonts/CenturyGothic.ttf', 'TrueTypeUnicode', '', 96);
	        $this->SetFont($CenturyGothic, '', 11);
	        $this->Cell(0, 15, 'Republic of the Philippines', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	        $this->Ln(4);
	        $BookmanOldStyle = TCPDF_FONTS::addTTFfont('libraries/TCPDF/custom-fonts/BookmanOldStyle.ttf', 'TrueTypeUnicode', '', 96);
	        $this->SetFont($BookmanOldStyle, 'B', 14);
	        $this->Cell(0, 15, 'CAVITE STATE UNIVERSITY', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	        $this->Ln(4);
	        $this->SetFont($BookmanOldStyle, 'B', 11);
	        $this->Cell(0, 15, 'Don Severino delas Alas Campus', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	        $this->Ln(4);
	        $this->SetFont($CenturyGothic, '', 10);
	        $this->Cell(0, 15, 'Indang, Cavite', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	    }
	}

	switch($report) {
		case 'incidentReport':
			$pdf = new PdfTemplate('L', 'mm', 'A4');
			$pdf->SetTitle('All Incident Reports - CEIT Guidance Record System');
			break;
		case 'consultationReport':
			$pdf = new PdfTemplate('L', 'mm', 'A4');
			$pdf->SetTitle('All Consultation Reports - CEIT Guidance Record System');
			break;
		case 'acceptanceSlip':
			$pdf = new PdfTemplate('L', 'mm', 'A4');
			$pdf->SetTitle('All Acceptance Slips - CEIT Guidance Record System');
			break;
		case 'referralSlip':
			$pdf = new PdfTemplate('L', 'mm', 'A4');
			$pdf->SetTitle('All Referral Slips - CEIT Guidance Record System');
			break;
	}

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'CEIT Guidance Record System', 'Cavite State University Main Campus');

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	$pdf->AddPage();
	$pdf->SetFont('times', '', 10);
	$pdf->Ln(5);

	switch($report) {
		case 'incidentReport':
			$pdf->WriteHTMLCell(190, 0, '', '', '<b>Incident Report - CEIT Guidance Record System</b>', 0, 1);
			break;
		case 'consultationReport':
			$pdf->WriteHTMLCell(190, 0, '', '', '<b>Consultation Report - CEIT Guidance Record System</b>', 0, 1);
			break;
		case 'acceptanceSlip':
			$pdf->WriteHTMLCell(190, 0, '', '', '<b>Acceptance Slip - CEIT Guidance Record System</b>', 0, 1);
			break;
		case 'referralSlip':
			$pdf->WriteHTMLCell(190, 0, '', '', '<b>Referral Slip - CEIT Guidance Record System</b>', 0, 1);
			break;
	}

	$pdf->WriteHTMLCell(190, 0, '', '', '<b>Generated by: </b> <i>' . ucfirst($_SESSION['username']) . '</i>', 0, 1);
	$pdf->WriteHTMLCell(190, 0, '', '', '<b>Date generated: </b> <i>' . $date . '</i>', 0, 1);
	$pdf->WriteHTMLCell(190, 10, '', '', '<b>Total: </b><i>' . count($rows) . '</i>', 0, 1);

	switch($report) {
		case 'incidentReport':
			$pdf->WriteHTMLCell(10, 10, '', '', '<b>No</b>', 1, 0);
			$pdf->WriteHTMLCell(20, 10, '', '', '<b>Username</b>', 1, 0);
 			$pdf->WriteHTMLCell(25, 10, '', '', '<b>User E-mail</b>', 1, 0);
			// $pdf->WriteHTMLCell(45, 10, '', '', '<b>Title</b>', 1, 0);
	 		$pdf->WriteHTMLCell(30, 10, '', '', '<b>Persons Involved</b>', 1, 0);
			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Witness Involved</b>', 1, 0);
			$pdf->WriteHTMLCell(55, 10, '', '', '<b>Incident Description</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Reported By</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Noted By</b>', 1, 1);
			foreach ($rows as $key => $value) {
		    	$pdf->WriteHTMLCell(10, 41, '', '', ($key+1), 1, 0);
		    	$pdf->WriteHTMLCell(20, 41, '', '', $value['name'], 1, 0);
		    	$pdf->WriteHTMLCell(25, 41, '', '', $value['email'], 1, 0);
		    	// $pdf->WriteHTMLCell(45, 41, '', '', $value['title'], 1, 0);
		    	$pdf->WriteHTMLCell(30, 41, '', '', $value['persons_involved'], 1, 0);
		    	$pdf->WriteHTMLCell(30, 41, '', '', $value['witness_involved'], 1, 0);
		    	$pdf->WriteHTMLCell(55, 41, '', '', $value['incident_description'], 1, 0);
		    	$pdf->WriteHTMLCell(25, 41, '', '', $value['reported_by'], 1, 0);
		    	$pdf->WriteHTMLCell(25, 41, '', '', $value['noted_by'], 1, 1);
			}
			break;
		case 'consultationReport':
			$pdf->WriteHTMLCell(10, 10, '', '', '<b>No</b>', 1, 0);
			// $pdf->WriteHTMLCell(45, 10, '', '', '<b>Title</b>', 1, 0);
 			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Type of Client</b>', 1, 0);
			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Name of Client</b>', 1, 0);
	 		$pdf->WriteHTMLCell(35, 10, '', '', '<b>Name of Organization</b>', 1, 0);
			$pdf->WriteHTMLCell(45, 10, '', '', '<b>Purpose</b>', 1, 0);
			$pdf->WriteHTMLCell(45, 10, '', '', '<b>Action Taken</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Recorded By</b>', 1, 1);
			foreach ($rows as $key => $value) {
				$pdf->WriteHTMLCell(10, 10, '', '', ($key+1), 1, 0);
				// $pdf->WriteHTMLCell(45, 10, '', '', $value['title'], 1, 0);
	 			$pdf->WriteHTMLCell(30, 10, '', '', $value['client'], 1, 0);
				$pdf->WriteHTMLCell(30, 10, '', '', $value['name_client'], 1, 0);
		 		$pdf->WriteHTMLCell(35, 10, '', '', $value['name_org'], 1, 0);
				$pdf->WriteHTMLCell(45, 10, '', '', $value['purpose'], 1, 0);
				$pdf->WriteHTMLCell(45, 10, '', '', $value['action_taken'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['recorded_by'], 1, 1);
			}
			break;
		case 'acceptanceSlip':
			$pdf->WriteHTMLCell(10, 10, '', '', '<b>No</b>', 1, 0);
			// $pdf->WriteHTMLCell(60, 10, '', '', '<b>Title</b>', 1, 0);
 			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Date</b>', 1, 0);
			$pdf->WriteHTMLCell(60, 10, '', '', '<b>Student Name</b>', 1, 0);
	 		$pdf->WriteHTMLCell(60, 10, '', '', '<b>Student Violation</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Allow Class</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Allow Phone</b>', 1, 1);
			foreach ($rows as $key => $value) {
				$pdf->WriteHTMLCell(10, 10, '', '', ($key+1), 1, 0);
				// $pdf->WriteHTMLCell(60, 10, '', '', $value['title'], 1, 0);
	 			$pdf->WriteHTMLCell(30, 10, '', '', $value['date_reported'], 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', $value['name_student'], 1, 0);
		 		$pdf->WriteHTMLCell(60, 10, '', '', $value['student_violation'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['allow_class'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['allow_phone'], 1, 1);
			}
			break;
		case 'referralSlip':
			$pdf->WriteHTMLCell(10, 10, '', '', '<b>No</b>', 1, 0);
			// $pdf->WriteHTMLCell(60, 10, '', '', '<b>Title</b>', 1, 0);
				$pdf->WriteHTMLCell(30, 10, '', '', '<b>Date</b>', 1, 0);
			$pdf->WriteHTMLCell(60, 10, '', '', '<b>Student Name</b>', 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', '<b>Course & Year</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Reason for Referral</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Incident Description</b>', 1, 1);
			foreach ($rows as $key => $value) {
				$pdf->WriteHTMLCell(10, 10, '', '', ($key+1), 1, 0);
				// $pdf->WriteHTMLCell(60, 10, '', '', $value['title'], 1, 0);
					$pdf->WriteHTMLCell(30, 10, '', '', $value['created_at'], 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', $value['name_student'] + $value['name_student'] , 1, 0);
					$pdf->WriteHTMLCell(60, 10, '', '', $value['course'] + $value['ryear'] , 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['reason'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['incident_description'], 1, 1);
			}
			break;
	}
	$pdf->Output();
?>