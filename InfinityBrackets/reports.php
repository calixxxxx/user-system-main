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
	if(!isset($_GET['range']) || empty($_GET['range'])) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Parameter";
		$response['message'] = "Range parameter not set or empty";
		echo json_encode($response);
		exit();
	}
	if(!isset($_GET['date']) || empty($_GET['date'])) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Parameter";
		$response['message'] = "Date parameter not set or empty";
		echo json_encode($response);
		exit();
	}
	// Validate data
	if(!in_array($_GET['report'], $reports)) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Report";
		$response['message'] = "Can't generate report";
		echo json_encode($response);
		exit();
	}

	$report = $_GET['report'];
	$range = $_GET['range'];
	$dateRange = $_GET['date'];
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

	$prefix = NULL;
	switch($report) {
		case "incidentReport":
			$prefix = "`ir`.";
			$statement = "SELECT `ir`.`id`, `ir`.`title`, `ir`.`incident_description`, `ir`.`time_reported`, `ir`.`time_incident`, `ir`.`persons_involved`, `ir`.`witness_involved`, `ir`.`reported_by`, `ir`.`noted_by`, `ir`.`created_at`, `ir`.`updated_at`, `u`.`name`, `u`.`email` FROM `incident_reports` `ir` INNER JOIN `users` `u` ON `ir`.`uid` = `u`.`id` WHERE `ir`.`deleted` != :in_active";
			$parameters = array('in_active' => 0);
			break;
		case "consultationReport":
			$prefix = "`cr`.";
			$statement = "SELECT `cr`.`id`, `cr`.`title`, `cr`.`client`, `cr`.`name_client`, `cr`.`name_org`, `cr`.`time_started`, `cr`.`time_ended`, `cr`.`date_consultation`, `cr`.`purpose`, `cr`.`action_taken`, `cr`.`recorded_by`, `cr`.`updated_at`, `cr`.`created_at`, `u`.`name`, `u`.`email` FROM `consultation_reports` `cr`INNER JOIN `users` `u` ON `cr`.`uid` != `u`.`id` WHERE `cr`.`deleted` != :in_active";
			$parameters = array('in_active' => 0);
			break;
		case "acceptanceSlip":
			$prefix = "`ar`.";
			$statement = "SELECT `ar`.`id`, `ar`.`title`, `ar`.`date_reported`, `ar`.`name_student`, `ar`.`allow_class`, `ar`.`allow_phone`, `ar`.`student_violation`, `ar`.`created_at`, `ar`.`updated_at`, `u`.`name`, `u`.`email` FROM `acceptance_reports` `ar` INNER JOIN `users` `u` ON `ar`.`uid` = `u`.`id` WHERE `ar`.`deleted` != :in_active";
			$parameters = array('in_active' => 0);
			break;
		case "referralSlip":
			$prefix = "`ar`.";
			$statement = "SELECT `ar`.`id`, `ar`.`title`, `ar`.`created_at`, `ar`.`student_fName`, `ar`.`student_lName`, `ar`.`course`, `ar`.`ryear`, `ar`.`reason`, `ar`.`incident_description`, `u`.`updated_at` FROM `referral_reports`'ar' WHERE `ar`.`deleted` != :in_active";
			// $statement = "SELECT * FROM `referral_reports` 'ar' WHERE `ar`.`deleted` != :in_active";
			$parameters = array('in_active' => 0);
			break;
	}
	$semester = NULL;
	$yearStart = NULL;
	$yearEnd = NULL;
	switch($range) {
		case "monthly":
			$statement .= " AND MONTH(`ir`.`created_at`) = :in_date";
			$parameters['in_date'] = $dateRange;
			break;
		case "semestral":
			$data = explode('-', $dateRange);
			$semester = $data[0];
			$yearStart = $data[1];
			$yearEnd = $data[1] + 1;
			switch($semester) {
				case "1st Semester":
					$statement .= " AND ((MONTH(" . $prefix . "`created_at`) >= 9 AND MONTH(" . $prefix . "`created_at`) <= 12) AND YEAR(" . $prefix . "`created_at`) = :in_year_start) OR (MONTH(" . $prefix . "`created_at`) = 1 AND YEAR(" . $prefix . "`created_at`) = :in_year_end)";
					$parameters['in_year_start'] = $yearStart;
					$parameters['in_year_end'] = $yearEnd;
					break;
				case "2nd Semester":
					$statement .= " AND (MONTH(" . $prefix . "`created_at`) >= 2 AND MONTH(" . $prefix . "`created_at`) <= 6) AND YEAR(" . $prefix . "`created_at`) = :in_year_end";
					$parameters['in_year_end'] = $yearEnd;
					break;
				case "Summer":
					$statement .= " AND (MONTH(" . $prefix . "`created_at`) = 7 OR MONTH(" . $prefix . "`created_at`) = 8) AND YEAR(" . $prefix . "`created_at`) = :in_year_end";
					$parameters['in_year_end'] = $yearEnd;
					break;
			}
			break;
		case "annual":
			$statement .= " AND YEAR(`ir`.`created_at`) = :in_date";
			$parameters['in_date'] = $dateRange;
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
			$pdf->SetTitle('All Acceptance Slips - CEIT Guidance Record System');
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
	$reportType = "";
	switch($range) {
		case "monthly":
			$reportType = '<b>Report Type: </b><i>Monthly (' . getMonthName($dateRange) . ')<i>';
			break;
		case "semestral":
			$reportType = '<b>Report Type: </b><i>Semestral (' . $semester . ' of ' . $yearStart . ' - ' . $yearEnd . ')<i>';
			break;
		case "annual":
			$reportType = '<b>Report Type: </b><i>Annually (' . $dateRange . ')<i>';
			break;
	}
	$pdf->WriteHTMLCell(190, 0, '', '', $reportType, 0, 1);
	$pdf->WriteHTMLCell(190, 10, '', '', '<b>Total: </b><i>' . count($rows) . '</i>', 0, 1);

	switch($report) {
		case 'incidentReport':
			$pdf->WriteHTMLCell(10, 10, '', '', '<b>No</b>', 1, 0);
			$pdf->WriteHTMLCell(20, 10, '', '', '<b>Username</b>', 1, 0);
 			$pdf->WriteHTMLCell(25, 10, '', '', '<b>User E-mail</b>', 1, 0);
			$pdf->WriteHTMLCell(45, 10, '', '', '<b>Title</b>', 1, 0);
	 		$pdf->WriteHTMLCell(30, 10, '', '', '<b>Persons Involved</b>', 1, 0);
			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Witness Involved</b>', 1, 0);
			$pdf->WriteHTMLCell(55, 10, '', '', '<b>Incident Description</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Reported By</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Noted By</b>', 1, 1);
			foreach ($rows as $key => $value) {
		    	$pdf->WriteHTMLCell(10, 41, '', '', ($key+1), 1, 0);
		    	$pdf->WriteHTMLCell(20, 41, '', '', $value['name'], 1, 0);
		    	$pdf->WriteHTMLCell(25, 41, '', '', $value['email'], 1, 0);
		    	$pdf->WriteHTMLCell(45, 41, '', '', $value['title'], 1, 0);
		    	$pdf->WriteHTMLCell(30, 41, '', '', $value['persons_involved'], 1, 0);
		    	$pdf->WriteHTMLCell(30, 41, '', '', $value['witness_involved'], 1, 0);
		    	$pdf->WriteHTMLCell(55, 41, '', '', $value['incident_description'], 1, 0);
		    	$pdf->WriteHTMLCell(25, 41, '', '', $value['reported_by'], 1, 0);
		    	$pdf->WriteHTMLCell(25, 41, '', '', $value['noted_by'], 1, 1);
			}
			break;
		case 'consultationReport':
			$pdf->WriteHTMLCell(10, 10, '', '', '<b>No</b>', 1, 0);
			$pdf->WriteHTMLCell(45, 10, '', '', '<b>Title</b>', 1, 0);
 			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Type of Client</b>', 1, 0);
			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Name of Client</b>', 1, 0);
	 		$pdf->WriteHTMLCell(35, 10, '', '', '<b>Name of Organization</b>', 1, 0);
			$pdf->WriteHTMLCell(45, 10, '', '', '<b>Purpose</b>', 1, 0);
			$pdf->WriteHTMLCell(45, 10, '', '', '<b>Action Taken</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Recorded By</b>', 1, 1);
			foreach ($rows as $key => $value) {
				$pdf->WriteHTMLCell(10, 10, '', '', ($key+1), 1, 0);
				$pdf->WriteHTMLCell(45, 10, '', '', $value['title'], 1, 0);
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
			$pdf->WriteHTMLCell(60, 10, '', '', '<b>Title</b>', 1, 0);
 			$pdf->WriteHTMLCell(30, 10, '', '', '<b>Date</b>', 1, 0);
			$pdf->WriteHTMLCell(60, 10, '', '', '<b>Student Name</b>', 1, 0);
	 		$pdf->WriteHTMLCell(60, 10, '', '', '<b>Student Violation</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Allow Class</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Allow Phone</b>', 1, 1);
			foreach ($rows as $key => $value) {
				$pdf->WriteHTMLCell(10, 10, '', '', ($key+1), 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', $value['title'], 1, 0);
	 			$pdf->WriteHTMLCell(30, 10, '', '', $value['date_reported'], 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', $value['name_student'], 1, 0);
		 		$pdf->WriteHTMLCell(60, 10, '', '', $value['student_violation'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['allow_class'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['allow_phone'], 1, 1);
			}
			break;
		case 'referralSlip':
			$pdf->WriteHTMLCell(10, 10, '', '', '<b>No</b>', 1, 0);
			$pdf->WriteHTMLCell(60, 10, '', '', '<b>Title</b>', 1, 0);
				$pdf->WriteHTMLCell(30, 10, '', '', '<b>Student First Name</b>', 1, 0);
			$pdf->WriteHTMLCell(60, 10, '', '', '<b>Student LastName</b>', 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', '<b>Course</b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Year/b>', 1, 0);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Reason For Referral</b>', 1, 1);
			$pdf->WriteHTMLCell(25, 10, '', '', '<b>Incident Description</b>', 1, 1);
			foreach ($rows as $key => $value) {
				$pdf->WriteHTMLCell(10, 10, '', '', ($key+1), 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', $value['title'], 1, 0);
					$pdf->WriteHTMLCell(30, 10, '', '', $value['student_fName'], 1, 0);
				$pdf->WriteHTMLCell(60, 10, '', '', $value['student_lName'], 1, 0);
					$pdf->WriteHTMLCell(60, 10, '', '', $value['course'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['year'], 1, 0);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['reason'], 1, 1);
				$pdf->WriteHTMLCell(25, 10, '', '', $value['incident_description'], 1, 1);
			}
			break;
	}
	$pdf->Output();

	function getMonthName($monthNum) {
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F');
		return $monthName;
	}
?>