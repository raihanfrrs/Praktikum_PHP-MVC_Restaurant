<?php 

class Signin_model{
	protected $firstTable = 'user_login';
	protected $secondTable = 'getsession_id';
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function checkFormUsername($data){
		$query = "SELECT COUNT(*) AS username FROM ".$this->firstTable." WHERE username=:username";
		$this->db->query($query);
		$this->db->bind('username', htmlentities(htmlspecialchars($data)));

		return $this->db->single();
	}

	public function checkFormEmail($data){
		$query = "SELECT COUNT(*) AS email FROM ".$this->firstTable." WHERE email=:email";
		$this->db->query($query);
		$this->db->bind('email', htmlentities(htmlspecialchars($data)));

		return $this->db->single();
	}

	public function checkFormPhone($data){
		$query = "SELECT COUNT(*) AS ponsel FROM ".$this->firstTable." WHERE ponsel=:ponsel";
		$this->db->query($query);
		$this->db->bind('ponsel', htmlentities(htmlspecialchars($data)));

		return $this->db->single();
	}

	public function getDataLogin($data, $field, $where){
		$query = "SELECT ".$field." FROM ".$this->firstTable." WHERE ".$where."=:data";
		$this->db->query($query);
		$this->db->bind('data', htmlentities(htmlspecialchars($data)));

		return $this->db->single();
	}

	public function checkUserCookiesInDatabase($data){
		$query = "SELECT * FROM ".$this->secondTable." WHERE user_login_id=:user_login_id";

		$this->db->query($query);
		$this->db->bind('user_login_id', htmlentities(htmlspecialchars($data['user_login_id'], ENT_QUOTES)));

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function updateUserCookiesInDatabase($data){
		$query = "UPDATE ".$this->secondTable." SET session_id=:session_id WHERE user_login_id=:user_login_id";
		$this->db->query($query);

		$this->db->bind('session_id', htmlentities(htmlspecialchars($data['csid'], ENT_QUOTES)));
		$this->db->bind('user_login_id', htmlentities(htmlspecialchars($data['user_login_id'], ENT_QUOTES)));

		$this->db->execute();
	}

	public function insertUserCookiesInDatabase($data){
		$query = "INSERT INTO ".$this->secondTable." VALUES(:user_login_id, :csid)";

		$this->db->query($query);
		$this->db->bind('user_login_id', htmlentities(htmlspecialchars($data['user_login_id'], ENT_QUOTES)));
		$this->db->bind('csid', htmlentities(htmlspecialchars($data['csid'], ENT_QUOTES)));

		$this->db->execute();
	}

	public function getCookiesFromDatabase($data){
		$query = "SELECT * FROM ".$this->secondTable." WHERE user_login_id=:user_login_id";

		$this->db->query($query);
		$this->db->bind('user_login_id', htmlentities(htmlspecialchars($data['user_login_id'], ENT_QUOTES)));

		return $this->db->single();
	}

	public function checkRowCookiesFromDatabase($data){
		$query = "SELECT * FROM ".$this->firstTable." INNER JOIN ".$this->secondTable." ON ".$this->firstTable.".user_login_id = ".$this->secondTable.".user_login_id WHERE session_id=:session_id";

		$this->db->query($query);
		$this->db->bind('session_id', htmlentities(htmlspecialchars($data['csid'], ENT_QUOTES)));

		$this->db->execute();
		return $this->db->rowCount();
	}

	public function getUsernameFromDatabaseWithCookie($data){
		$query = "SELECT * FROM ".$this->firstTable." INNER JOIN ".$this->secondTable." ON ".$this->firstTable.".user_login_id = ".$this->secondTable.".user_login_id WHERE session_id=:session_id";

		$this->db->query($query);
		$this->db->bind('session_id', htmlentities(htmlspecialchars($data['csid'], ENT_QUOTES)));

		return $this->db->single();
	}
}