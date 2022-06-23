<?php 

class Reporting extends Controller{
	protected $header;
	protected $body;
	protected $getRow;

	public function __construct(){
		new Validation;
	}

	public function Sales(){
		$this->getRow = $this->model('Report_model')->reportSales();

		$this->header = [
			'title' => 'Reporting Sales'
		];

		$this->view('templates/header', $this->header);
		$this->view('reporting/sales', $this->getRow);
		$this->view('templates/footer');
	}

}