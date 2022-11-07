<?php
class ticket_priority{
	private $db;
	
	#Pass in an internal_user object. Need to ensure that the 
	function __construct($database, $user=null){
		$this->db = $database;
	}
	
	function GetAllPriorityNames(){
		return $this->db->query("SELECT Priority_Level, Priority_Name FROM Priority");
	}
}