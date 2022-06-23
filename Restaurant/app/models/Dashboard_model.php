<?php 

class Dashboard_model{
	protected $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getAggregationDashboard($type, $field){
		$query = "SELECT ".$type." AS value FROM ".$field;

		$this->db->query($query);
		return $this->db->single();
	}

}