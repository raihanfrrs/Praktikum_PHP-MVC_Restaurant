<?php 

class Transaction_model{
	protected $firstTable = 'transaksi';
	protected $secondTable = 'detail_transaksi';
	protected $thirdTable = 'temp_cart';
	protected $fourthTable = 'produk';
	protected $fifthTable = 'customer';
	protected $foreignKey;
	protected $counter;
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getDataTempCart($data, $field){
		$query = "SELECT * FROM ".$this->thirdTable." WHERE ".$field." = :data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));

		return $this->db->single();
	}

	public function insertTempCart($data){
		$query = "INSERT INTO ".$this->thirdTable." VALUES('', :customer_nama, :alamat, :ponsel, :email, :produk_id, :produk_nama, :harga, :qty, :tanggal, 0, :pegawai_id)";

		$this->db->query($query);
		$this->db->bind('customer_nama', htmlentities(htmlspecialchars($data['customer_nama'], ENT_QUOTES)));
		$this->db->bind('alamat', htmlentities(htmlspecialchars($data['alamat'], ENT_QUOTES)));
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));
		$this->db->bind('produk_id', htmlentities(htmlspecialchars($data['produk_id'], ENT_QUOTES)));
		$this->db->bind('produk_nama', htmlentities(htmlspecialchars($data['produk_nama'], ENT_QUOTES)));
		$this->db->bind('harga', htmlentities(htmlspecialchars($data['harga']*$data['qty'], ENT_QUOTES)));
		$this->db->bind('qty', htmlentities(htmlspecialchars($data['qty'], ENT_QUOTES)));
		$this->db->bind('tanggal', htmlentities(htmlspecialchars($data['tanggal'], ENT_QUOTES)));
		$this->db->bind('pegawai_id', htmlentities(htmlentities($data['pegawai_id'], ENT_QUOTES)));
		
		return $this->db->execute();
	}

	public function updateDataTempCart($data, $update){
		$query = "UPDATE ".$this->thirdTable." SET ".$update." = :data WHERE produk_id=:produk_id AND pegawai_id=:pegawai_id";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data['data'], ENT_QUOTES)));
		$this->db->bind('produk_id', htmlentities(htmlspecialchars($data['produk_id'], ENT_QUOTES)));
		$this->db->bind('pegawai_id', htmlentities(htmlspecialchars($data['pegawai_id'], ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteTempCart($data, $field, $type){
		if ($type == 'delete') {
			$query = "DELETE FROM ".$this->thirdTable." WHERE ".$field['produk_id']."=:produk_id AND ".$field['pegawai_id']."=:pegawai_id";
			$this->db->query($query);
			$this->db->bind('produk_id', htmlentities(htmlspecialchars($data['produk_id'], ENT_QUOTES)));
			$this->db->bind('pegawai_id', htmlentities(htmlspecialchars($data['pegawai_id'], ENT_QUOTES)));
			$this->db->execute();

		}else if($type == 'reset'){
			for ($a=0; $a < count($data['produk_id']); $a++) { 
				$query = "DELETE FROM ".$this->thirdTable." WHERE ".$field['produk_id']."=:produk_id AND ".$field['pegawai_id']."=:pegawai_id";
				$this->db->query($query);
				$this->db->bind('produk_id', htmlentities(htmlspecialchars($data['produk_id'][$a], ENT_QUOTES)));
				$this->db->bind('pegawai_id', htmlentities(htmlspecialchars($data['pegawai_id'], ENT_QUOTES)));
				$this->db->execute();
			}
		}

		return $this->db->rowCount();
	}

	public function insertDataCustomer($data){
		$query = "INSERT INTO ".$this->fifthTable." VALUES('', :customer_nama, :alamat, :ponsel, :email)";

		$this->db->query($query);
		$this->db->bind('customer_nama', htmlentities(htmlspecialchars($data['customer_nama'], ENT_QUOTES)));
		$this->db->bind('alamat', htmlentities(htmlspecialchars($data['alamat'], ENT_QUOTES)));
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));
		$this->db->execute();

		$this->db->query("SELECT LAST_INSERT_ID() AS ID");
		return $this->db->single();
	}

	public function InsertDataTransaksi($data){
		$query = "INSERT INTO ".$this->firstTable." VALUES('', :customer_id, :pegawai_id, :catatan, :tgl_transaksi, :grand_total)";
		$this->db->query($query);
		$this->db->bind('customer_id', $data['customer_id']);
		$this->db->bind('pegawai_id', htmlentities(htmlspecialchars($data['pegawai_id'], ENT_QUOTES)));
		$this->db->bind('catatan', htmlentities(htmlspecialchars($data['catatan'], ENT_QUOTES)));
		$this->db->bind('tgl_transaksi', htmlentities(htmlspecialchars($data['tgl_transaksi'], ENT_QUOTES)));
		$this->db->bind('grand_total', htmlentities(htmlspecialchars($data['grand_total'], ENT_QUOTES)));
		$this->db->execute();

		$this->db->query("SELECT LAST_INSERT_ID() AS ID");
		$this->foreignKey = $this->db->single();

		for ($a=0; $a < count($data['produk_id']); $a++) { 
			$query = "INSERT INTO ".$this->secondTable." VALUES('', :transaksi_id, :produk_id, :total_qty, :subtotal, :potongan)";
			$this->db->query($query);
			$this->db->bind('transaksi_id', $this->foreignKey['ID']);
			$this->db->bind('produk_id', $data['produk_id'][$a]);
			$this->db->bind('total_qty', $data['total_qty'][$a]);
			$this->db->bind('subtotal', $data['subtotal'][$a]);
			$this->db->bind('potongan', $data['potongan'][$a]);
			$this->db->execute();
		}

		for ($a=0; $a < count($data['produk_id']); $a++) { 
			$query = "DELETE FROM ".$this->thirdTable." WHERE produk_id=:produk_id AND pegawai_id=:pegawai_id";
			$this->db->query($query);
			$this->db->bind('produk_id', $data['produk_id'][$a]);
			$this->db->bind('pegawai_id', $data['pegawai_id']);
			$this->db->execute();
		}

		$this->counter = $this->db->rowCount();

		$data = [
			'rowCount' => $this->counter,
			'foreignKey' => $this->foreignKey['ID']
		];
		
		return $data;
	}

}