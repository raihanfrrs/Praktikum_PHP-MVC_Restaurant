<?php 

class Report_model{
	protected $firstTable = 'transaksi';
	protected $secondTable = 'detail_transaksi';
	protected $thirdTable = 'customer';
	protected $fourthTable = 'pegawai';
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function reportSales(){
		$query = "SELECT ".$this->firstTable.".*, SUM(".$this->secondTable.".total_qty) as amount, ".$this->thirdTable.".*, ".$this->fourthTable.".* FROM ".$this->firstTable." INNER JOIN ".$this->secondTable." ON ".$this->firstTable.".transaksi_id = ".$this->secondTable.".transaksi_id INNER JOIN ".$this->thirdTable." ON ".$this->firstTable.".customer_id = ".$this->thirdTable.".customer_id INNER JOIN ".$this->fourthTable." ON ".$this->firstTable.".pegawai_id = ".$this->fourthTable.".pegawai_id GROUP BY ".$this->secondTable.".transaksi_id";

		$this->db->query($query);
		return $this->db->resultSet();
	}
}