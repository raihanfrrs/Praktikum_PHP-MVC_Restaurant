<?php 

class Dashboard extends Controller{
	protected $header;
	protected $body;
	protected $getRow;

	public function __construct(){
		new Validation;

		if(isset($_SESSION['notif']) && !empty($_SESSION['notif'])){
			Flasher::setFlash($_SESSION['notif']['pesan'], $_SESSION['notif']['aksi'], $_SESSION['notif']['tipe'], $_SESSION['notif']['user']);

			unset($_SESSION['notif']);
		}
	}

	public function index(){
		$totalOrder = $this->model('Dashboard_model')->getAggregationDashboard('COUNT(*)', 'transaksi');
		$totalIncome = $this->model('Dashboard_model')->getAggregationDashboard('SUM(grand_total)', 'transaksi');
		$totalProduct = $this->model('Dashboard_model')->getAggregationDashboard('COUNT(*)', 'produk');
		$totalCashier = $this->model('Dashboard_model')->getAggregationDashboard('COUNT(*)', 'pegawai');

		$this->header = [
			'title' => 'Dashboard'
		];

		$this->body = [
			'totalOrder' => $totalOrder['value'],
			'totalIncome' => $totalIncome['value'],
			'totalProduct' => $totalProduct['value'],
			'totalCashier' => $totalCashier['value']
		];

		$this->view('templates/header', $this->header);
		$this->view('dashboard/index', $this->body);
		$this->view('templates/footer');
	}
}