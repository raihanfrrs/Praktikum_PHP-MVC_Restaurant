<?php 

class Customer_model{
	protected $firstTable = 'customer';
	protected $getRow;
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getAllCustomer(){
		$query = "SELECT * FROM ".$this->firstTable;

		$this->db->query($query);
		return $this->db->resultSet();
	}

	public function getDataCustomer($data, $field, $type){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field." =:data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));

		if($type == 'all'){
			return $this->db->resultSet();
		}else if($type == 'single'){
			return $this->db->single();
		}
	}

	public function checkAnyCustomer($data, $field){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field." = :data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function insertCustomerData($data){
		$query = "INSERT INTO ".$this->firstTable." VALUES('', :customer_nama, :alamat, :ponsel, :email)";

		$this->db->query($query);
		$this->db->bind('customer_nama', htmlentities(htmlspecialchars($data['customer_nama'], ENT_QUOTES)));
		$this->db->bind('alamat', htmlentities(htmlspecialchars($data['alamat'], ENT_QUOTES)));
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteCustomer($data){
		$query = "DELETE FROM ".$this->firstTable." WHERE customer_id=:customer_id";

		$this->db->query($query);
		$this->db->bind('customer_id', htmlentities(htmlspecialchars($data, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function editCustomer($data, $id, $field){
		$query = "UPDATE ".$this->firstTable." SET customer_nama=:customer_nama, alamat=:alamat, ponsel=:ponsel, email=:email WHERE ".$field."=:data";

		$this->db->query($query);
		$this->db->bind('customer_nama', htmlentities(htmlspecialchars($data['customer_nama'], ENT_QUOTES)));
		$this->db->bind('alamat', htmlentities(htmlspecialchars($data['alamat'], ENT_QUOTES)));
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));
		$this->db->bind('data', htmlentities(htmlspecialchars($id, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

}