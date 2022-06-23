<?php 

class Categories_model{
	protected $firstTable = 'jenis_produk';
	protected $getRow;
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getAllCategory(){
		$query = "SELECT * FROM ".$this->firstTable;

		$this->db->query($query);
		return $this->db->resultSet();
	}

	public function getDataCategory($data, $field){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field."=:data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		return $this->db->single();
	}

	public function getDataCategoryWhereNot($data, $field, $result){
		$query = "SELECT * FROM ".$this->firstTable." WHERE NOT ".$field." = :data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));

		if($result == 'all'){
			return $this->db->resultSet();
		}else if($result == 'single'){
			return $this->db->single();
		}
	}

	public function checkAnyCategory($data, $field){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field." = :data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function insertCategoryData($data){
		$query = "INSERT INTO ".$this->firstTable." VALUES('', :jenis_nama)";

		$this->db->query($query);
		$this->db->bind('jenis_nama', htmlentities(htmlspecialchars($data['kategori'], ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteCategory($data){
		$query = "DELETE FROM ".$this->firstTable." WHERE jenis_id=:jenis_id";

		$this->db->query($query);
		$this->db->bind('jenis_id', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function editCategory($data, $field, $value, $where){
		$query = "UPDATE ".$this->firstTable." SET ".$field." = :data WHERE ".$where." = :value";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		$this->db->bind('value', htmlentities(htmlspecialchars($value, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}
}