<?php

require_once '../../libraries/TCPDF/tcpdf.php';

class PdfTemplate extends TCPDF {
//Page header
    public function Header() {
        // Logo
        //if($_GET['tab'] == 'delinquents') {
        //  $this->Image('storage/images/CvSU-logo.png', 90, 8, 20, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        //} else {
            $this->Image('../../storage/images/CvSU-logo.png', 50, 8, 20, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        //}
        // Title
        $this->Ln(1);
        $CenturyGothic = TCPDF_FONTS::addTTFfont('../../libraries/TCPDF/custom-fonts/CenturyGothic.ttf', 'TrueTypeUnicode', '', 96);
        $this->SetFont($CenturyGothic, '', 11);
        $this->Cell(0, 15, 'Republic of the Philippines', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(4);
        $BookmanOldStyle = TCPDF_FONTS::addTTFfont('../../libraries/TCPDF/custom-fonts/BookmanOldStyle.ttf', 'TrueTypeUnicode', '', 96);
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
$pdf->SetTitle('List of Users - Delinquent Grades Monitoring System');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Delinquent Grades Monitoring System', 'Cavite State University Main Campus');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->AddPage();
$pdf->SetFont('times', '', 10);
$pdf->Ln(5);
$pdf->WriteHTMLCell(190, 0, '', '', '<b>Master List of Users</b>', 0, 1);
$pdf->WriteHTMLCell(190, 0, '', '', '<b>List of Users</b>', 0, 1);
$pdf->WriteHTMLCell(190, 0, '', '', 'Cavite State University - Main Campus', 0, 1);
$pdf->Output();