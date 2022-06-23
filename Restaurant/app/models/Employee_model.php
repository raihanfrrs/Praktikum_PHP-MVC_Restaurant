<?php 

class Employee_model{
	protected $firstTable = 'user_login';
	protected $secondTable = 'pegawai';
	protected $getRow;
	protected $counter;
	protected $hash;
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getDataEmployee($data, $field){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field."=:data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));

		return $this->db->single();
	}

	public function getInnerDataEmployee($data, $field, $type){
		$query = "SELECT * FROM ".$this->firstTable." INNER JOIN ".$this->secondTable." ON ".$this->firstTable.".pegawai_id = ".$this->secondTable.".pegawai_id WHERE ".$field." =:data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data, ENT_QUOTES)));

		if($type == 'all'){
			return $this->db->resultSet();
		}else if($type == 'single'){
			return $this->db->single();
		}
	}

	public function checkAnyEmployeeIfExist($data, $field){
		$query = "SELECT * FROM ".$this->firstTable." WHERE ".$field."=:data";

		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data['username'], ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function updateDataEmployee($data, $field, $where){
		$this->db->query("SELECT * FROM ".$this->firstTable." WHERE ".$field." =:where");
		$this->db->bind('where', htmlentities(htmlspecialchars($where, ENT_QUOTES)));
		$this->getRow = $this->db->single();

		$query = "UPDATE ".$this->firstTable." SET username=:username WHERE user_login_id=:user_login_id";
		$this->db->query($query);
		$this->db->bind('username', htmlentities(htmlspecialchars($data['username'], ENT_QUOTES)));
		$this->db->bind('user_login_id', htmlentities(htmlspecialchars($where, ENT_QUOTES)));
		$this->db->execute();
		$this->counter += $this->db->rowCount();

		$query = "UPDATE ".$this->secondTable." SET pegawai_nama=:pegawai_nama, alamat=:alamat, ponsel=:ponsel, email=:email WHERE pegawai_id=:pegawai_id";
		$this->db->query($query);
		$this->db->bind('pegawai_nama', htmlentities(htmlspecialchars($data['pegawai_nama'], ENT_QUOTES)));
		$this->db->bind('alamat', htmlentities(htmlspecialchars($data['alamat'], ENT_QUOTES)));
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));
		$this->db->bind('pegawai_id', htmlentities(htmlspecialchars($this->getRow['pegawai_id'], ENT_QUOTES)));
		$this->db->execute();
		$this->counter += $this->db->rowCount();

		return $this->counter;
	}

	public function updatePasswordEmployee($data, $field, $where){
		$query = "UPDATE ".$this->firstTable." SET password=:password WHERE ".$field." =:where";
		$this->hash = password_hash(htmlentities(htmlspecialchars($data['password'], ENT_QUOTES)), PASSWORD_DEFAULT);
		$this->db->query($query);
		$this->db->bind('password', $this->hash);
		$this->db->bind('where', htmlentities(htmlspecialchars($where, ENT_QUOTES)));
		$this->db->execute();

		return $this->db->rowCount();
	}
}