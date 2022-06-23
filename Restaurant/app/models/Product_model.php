<?php 

class Product_model{
	protected $firstTable = 'produk';
	protected $secondTable = 'jenis_produk';
	protected $getRow;
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getAllProduct(){
		$query = "SELECT * FROM ".$this->firstTable;

		$this->db->query($query);
		return $this->db->resultSet();
	}

	public function getDataProduct($data, $field){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field." =:data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		return $this->db->single(); 
	}

	public function getAllProductAndCategory(){
		$query = "SELECT ".$this->firstTable.".*, ".$this->secondTable.".* FROM ".$this->firstTable." INNER JOIN ".$this->secondTable." ON ".$this->firstTable.".jenis_id = ".$this->secondTable.".jenis_id";

		$this->db->query($query);
		return $this->db->resultSet();
	}

	public function getAllProductAndCategoryByCond($data, $field){
		$query = "SELECT ".$this->firstTable.".*, ".$this->secondTable.".* FROM ".$this->firstTable." INNER JOIN ".$this->secondTable." ON ".$this->firstTable.".jenis_id = ".$this->secondTable.".jenis_id WHERE ".$this->firstTable.".".$field." = :data";

		$this->db->query($query);
		$this->db->bind('data', htmlspecialchars(htmlentities($data, ENT_QUOTES)));
		return $this->db->single();
	}

	public function checkAnyProduct($data, $field){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field."=:data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function insertProductData($data){
		$query = "INSERT INTO ".$this->firstTable." VALUES('', :produk_nama, :harga, :deskripsi, :jenis_id)";

		$this->db->query($query);
		$this->db->bind('produk_nama', htmlentities(htmlspecialchars($data['produk_nama'], ENT_QUOTES)));
		$this->db->bind('harga', htmlentities(htmlspecialchars($data['harga'], ENT_QUOTES)));
		$this->db->bind('deskripsi', htmlentities(htmlspecialchars($data['deskripsi'], ENT_QUOTES)));
		$this->db->bind('jenis_id', htmlentities(htmlspecialchars($data['kategori'], ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteProduct($data){
		$query = "DELETE FROM ".$this->firstTable." WHERE produk_id=:produk_id";

		$this->db->query($query);
		$this->db->bind('produk_id', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function editProduct($data, $id, $field){
		$query = "UPDATE ".$this->firstTable." SET produk_nama=:produk_nama, harga=:harga, deskripsi=:deskripsi, jenis_id=:jenis_id WHERE ".$field." =:data";

		$this->db->query($query);
		$this->db->bind('produk_nama', htmlentities(htmlspecialchars($data['produk_nama'], ENT_QUOTES)));
		$this->db->bind('harga', htmlentities(htmlspecialchars($data['harga'], ENT_QUOTES)));
		$this->db->bind('deskripsi', htmlentities(htmlspecialchars($data['deskripsi'], ENT_QUOTES)));
		$this->db->bind('jenis_id', htmlentities(htmlspecialchars($data['kategori'], ENT_QUOTES)));
		$this->db->bind('data', htmlentities(htmlspecialchars($id, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}
}