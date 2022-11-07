<?php
class Status{
	private $Status_Code;
	private $Status_Name;
	private $db;
	
	function __construct($database){
		$this->db = $database;
	}
	
	function CreateStatus($code, $name){
		$return = $this->db->query("INSERT INTO `Status` (Status_Code, Status_Name) VALUES (?,?)", [$code, $name], false);
		return $return;
	}
	
	function UpdateStatus($code, $name){
		$return = $this->db->query("UPDATE `Status` SET ? = ? WHERE `Status_Code` = ?", [$code, $name], false);
		return $return;
	}
	
	function DeleteStatus($ID){
		$return = $this->db->query("DELETE FROM `Status` WHERE `Status_Code` = ?", [$ID], false);
		return $return;
	}
	function GetAll(){
		$return = $this->db->query("SELECT * FROM Status");
		return $return;
	}
}