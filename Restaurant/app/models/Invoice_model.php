<?php 

class Invoice_model{
	protected $firstTable = 'transaksi';
	protected $secondTable = 'detail_transaksi';
	protected $thirdTable = 'customer';
	protected $fourthTable = 'pegawai';
	protected $fifthTable = 'produk';
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getDataForInvoice($data){
		$query = "SELECT transaksi.*, detail_transaksi.*, customer.customer_nama, customer.alamat as customer_alamat, customer.email as customer_email, pegawai.*, produk.* FROM transaksi INNER JOIN customer ON transaksi.customer_id = customer.customer_id INNER JOIN pegawai ON transaksi.pegawai_id = pegawai.pegawai_id INNER JOIN detail_transaksi ON transaksi.transaksi_id = detail_transaksi.transaksi_id INNER JOIN produk ON detail_transaksi.produk_id = produk.produk_id WHERE transaksi.transaksi_id = :transaksi_id";

		$this->db->query($query);
		$this->db->bind('transaksi_id', htmlentities(htmlspecialchars($data, ENT_QUOTES)));

		return $this->db->resultSet();
	}

}