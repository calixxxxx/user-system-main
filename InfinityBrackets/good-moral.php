<?php
	require_once 'libraries/TCPDF/tcpdf.php';
	session_start();

	$response = array();
	$DITcourses = array("BSOA", "BSIT", "BSCS", "BSArchi");

	if(!isset($_GET['name']) && empty($_GET['name'])) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Parameter";
		$response['message'] = "Name parameter not set or empty";
		echo json_encode($response);
		exit();
	}
	$titles = array("mr", "ms");
	if(!isset($_GET['title']) && empty($_GET['title']) && !in_array($_GET['title'], $titles)) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Parameter";
		$response['message'] = "Title parameter not set or empty";
		echo json_encode($response);
		exit();
	}
	$courses = array(
		'BSIT' => "Bachelor of Science in Information Technology",
		'BSCS' => "Bachelor of Science in Computer Science",
		'BSOA' => "Bachelor of Science in Office Administration",
		'BSArchi' => "Bachelor of Science in Architecture",
		'BSABE' => "Bachelor of Science in Agricultural and Biosystems Engineering",
		'BSCE' => "Bachelor of Science in Civil Engineering",
		'BSEE' => "Bachelor of Science in Electrical Engineering",
		'BSCpE' => "Bachelor of Science in Computer Engineering",
		'BSECE' => "Bachelor of Science in Electronics and Communication Engineering",
		'BSIE' => "Bachelor of Science in Industrial Engineering",
		'BSIndt-ET' => "Bachelor of Industrial Technology major in Electrical Technology",
		'BSIndt-AT' => "Bachelor of Industrial Technology major in Automotive Technology",
		'BSIndt-ELEX' => "Bachelor of Industrial Technology major in Electronics"
	);
	if(!isset($_GET['course']) && empty($_GET['course']) && !array_key_exists($_GET['course'], $courses)) {
		$response['status'] = 'error';
		$response['title'] = "Invalid Parameter";
		$response['message'] = "Courses parameter not set or empty";
		echo json_encode($response);
		exit();
	}

	// $sentence = "mysql:host=localhost;dbname=db_user_system";
	// $username = "root";
	// $password = "";
	// $connection = NULL;

	// try {
	// 	$connection = new PDO($sentence, $username, $password);
	// } catch(PDOExeption $e) {
	// 	throw new Exception($e->getMessage(), 1);
	// 	exit();
	// }

	$name = strtoupper(strip_tags($_GET['name']));
	$title = ucfirst(strtolower(strip_tags($_GET['title']))) . ".";
	$course = $courses[$_GET['course']];

	$date = date('Y') . '-' . date('m') . '-' . date('d');
	$dateOnLetter = date('F') . ' ' . date('d') . ' ,' .date('Y');

	class PdfTemplate extends TCPDF {
    	//Page header
	    public function Header() {
	        // Logo
		     $this->Image('storage/images/CvSU-logo.png', 50, 8, 20, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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

	$pdf = new PdfTemplate('P', 'mm', 'A4');
	$pdf->SetTitle('Good Moral - CEIT Guidance Record System');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'CEIT Guidance Record System', 'Cavite State University Main Campus');
	$pdf->setPrintFooter(false);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	$pdf->AddPage();
	$pdf->SetFont('times', '', 10);
	$pdf->Ln(5);

	$textIndent = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	$pdf->SetFont('times', 'B', 12);
	$pdf->Cell(0, 15, 'COLLEGE OF ENGINEERING AND INFORMATION TECHNOLOGY', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	$pdf->Ln(15);
	$pdf->SetFont('times', 'B', 16);
	$pdf->Cell(0, 15, 'CERTIFICATION OF GOOD MORAL CHARACTER', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	$pdf->Ln(20);
	$Arial = TCPDF_FONTS::addTTFfont('libraries/TCPDF/custom-fonts/Arial.ttf', 'TrueTypeUnicode', '', 96);
	$ArialBold = TCPDF_FONTS::addTTFfont('libraries/TCPDF/custom-fonts/ArialBold.ttf', 'TrueTypeUnicode', '', 96);
	$pdf->SetFont($Arial, '', 11);
	$pdf->Cell(0, 15, $dateOnLetter, 0, false, 'R', 0, '', 0, false, 'M', 'M');
	$pdf->Ln(15);
	$pdf->SetFont($Arial, 'B', 11);
	$pdf->Cell(0, 15, 'TO WHOM IT MAY CONCERN:', 0, false, 'L', 0, '', 0, false, 'M', 'M');
	$pdf->Ln(10);
	$pdf->SetFont($Arial, '', 11);
	$pdf->setCellHeightRatio(1.5);
	$pdf->WriteHTMLCell(180, 10, '', '', $textIndent . 'This is to certify that ' . $title . ' <b>' . $name . '</b>, a <b><u>' . $course . '</u></b> student has shown good moral character. ' . ($title == "Mr." ? "He" : "She") . ' was well-disciplined and had not violated any of the rules and regulations in our college.', 0, 2);
	$pdf->writeHTML($textIndent . 'This certification is issued upon request of the bearer for whatever legal purpose it may serve ' . ($title == "Mr." ? "him" : "her") . '.', true, 0, true, 0);
	$pdf->Ln(20);
	$pdf->SetFont($Arial, 'B', 11);
	if(in_array($_GET['course'], $DITcourses)) {
		$pdf->Cell(0, 15, 'JO ANNE C. NUESTRO, Ph.D', 0, false, 'R', 0, '', 0, false, 'M', 'M');
		$pdf->Ln(5);
		$pdf->SetFont($Arial, '', 11);
		$pdf->Cell(0, 15, 'College Guidance Facilitator  ', 0, false, 'R', 0, '', 0, false, 'M', 'M');
		$pdf->Image('storage/images/Nuestro.png', 155, 130, 24, 24, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	} else {
		$pdf->Cell(0, 15, 'ANDY A. DIZON           ', 0, false, 'R', 0, '', 0, false, 'M', 'M');
		$pdf->Ln(5);
		$pdf->SetFont($Arial, '', 11);
		$pdf->Cell(0, 15, 'College Guidance Facilitator  ', 0, false, 'R', 0, '', 0, false, 'M', 'M');
		$pdf->Image('storage/images/Dizon.png', 155, 130, 24, 24, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	}
	$pdf->Output();
?>