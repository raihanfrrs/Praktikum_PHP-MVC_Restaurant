<?php 

class Signup_model{
	protected $firstTable = 'user_login';
	protected $row;
	protected $counter = 0;
	protected $hash;
	protected $foreignKey;
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function checkUniqueUsername($data){
		$query = "SELECT COUNT(*) as username FROM ".$this->firstTable." WHERE username=:username";

		$this->db->query($query);
		$this->db->bind('username', htmlentities(htmlspecialchars($data['username'], ENT_QUOTES)));

		return $this->db->single();
	}

	public function checkUniqueEmail($data){
		$query = "SELECT COUNT(*) as email FROM ".$this->firstTable." WHERE email=:email";

		$this->db->query($query);
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));

		return $this->db->single();
	}

	public function checkUniquePhone($data){
		$query = "SELECT COUNT(*) as ponsel FROM ".$this->firstTable." WHERE ponsel=:ponsel";

		$this->db->query($query);
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));

		return $this->db->single();
	}

	public function insertEmployeeData($data){
		$query = "INSERT INTO pegawai VALUES('','','', :ponsel, :email)";
		$this->db->query($query);
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));

		$this->db->execute();
		$this->counter += $this->db->rowCount();

		$this->db->query("SELECT LAST_INSERT_ID() AS ID");
		$this->foreignKey = $this->db->single();

		$query = "INSERT INTO user_login VALUES('', :username, :email, :ponsel, :password, :pegawai_id)";
		$this->hash = password_hash(htmlentities(htmlspecialchars($data['password'])), PASSWORD_DEFAULT);
		$this->db->query($query);
		$this->db->bind('username', htmlentities(htmlspecialchars($data['username'], ENT_QUOTES)));
		$this->db->bind('email', htmlentities(htmlspecialchars($data['email'], ENT_QUOTES)));
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data['ponsel'], ENT_QUOTES)));
		$this->db->bind('password', $this->hash);
		$this->db->bind('pegawai_id', $this->foreignKey['ID']);
		$this->db->execute();

		$this->counter += $this->db->rowCount();

		return $this->counter;
	}
}