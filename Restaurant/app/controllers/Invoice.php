<?php 

class Invoice extends Controller{
	protected $header;
	protected $body;
	protected $getRow;

	public function __construct(){
		new Validation;
	}

	public function index($data){
		if (empty($_SESSION['transaction_id']) || $_SESSION['transaction_id'] != $data) {
			header('Location: '.BASEURL.'/Dashboard');
			exit;
		}

		$this->header = [
			'title' => 'Invoice'
		];

		$this->body = [
			'data' => $this->model('Invoice_model')->getDataForInvoice($data)
		];

		$this->view('templates/header', $this->header);
		$this->view('invoice/index', $this->body);
		$this->view('templates/footer');
	}
}