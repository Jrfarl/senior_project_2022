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
	
	function CreatePriority($code, $name){
		$return = $this->db->query("INSERT INTO `Priority` (Priority_Level, Priority_Name) VALUES (?,?)", [$code, $name], false);
		return $return;
	}
	
	function UpdatePriority($code, $name){
		$return = $this->db->query("UPDATE `Priority` SET ? = ? WHERE `Priority_Level` = ?", [$code, $name], false);
		return $return;
	}
	
	function DeletePriority($ID){
		$return = $this->db->query("DELETE FROM `Priority` WHERE `Priority_Level` = ?", [$ID], false);
		return $return;
	}
	function GetAll(){
		$priority_array = [];
		$return = $this->db->query("SELECT * FROM Priority");
		foreach($return as $r){
			$priority_array[$r['Priority_Level']] = $r['Priority_Name'];
		}
		return $priority_array;
	}
}