<?php

require_once '../InfinityBrackets/libraries/TCPDF/tcpdf.php';
require_once '../InfinityBrackets/app/Controllers/PdfTemplate.php';

class Export {

	public $RESPONSE = array();
	protected $DATA = array();
	protected $REPORT = NULL;
	protected $REPORTS = array("incidentReport", "consultationReport", "acceptanceSlip");

	public function __construct($paramaters) {
		if(array_key_exists('data', $paramaters)) {
			$this->DATA = $paramaters['data'];
		} else {
			$this->DATA = array();
		}
		if(array_key_exists('report', $paramaters)) {
			$this->REPORT = $paramaters['report'];
		} else {
			$this->REPORT = NULL;
		}
	}

	public function Validate() {
		if(is_null($this->REPORT) || !in_array($this->REPORT, $this->REPORTS)) {
			$this->RESPONSE['status'] = 'error';
			$this->RESPONSE['title'] = "Invalid Report";
			$this->RESPONSE['message'] = "Can't generate report";
			return FALSE;
		}
		if(count($this->DATA) <= 0) {
			$this->RESPONSE['status'] = 'warning';
			$this->RESPONSE['title'] = "No data";
			$this->RESPONSE['message'] = "Nothing to export";
			return FALSE;
		}
		return TRUE;
	}

	public function Render() {
		if(!$this->Validate()) {
			echo json_encode($this->RESPONSE);
			return;
		}
	}
}