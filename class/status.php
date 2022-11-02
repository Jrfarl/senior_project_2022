<?php
class Status{
	private $Status_Code;
	private $Status_Name;
	
	function CreateStatus($code, $name){
		$return = $database->query("INSERT INTO `Status` (Status_Code, Status_Name) VALUES (?,?)", [$code, $name], false);
		return $return;
	}
	
	function UpdateStatus($code, $name){
		$return = $database->query("UPDATE `Status` SET ? = ? WHERE `Status_Code` = ?", [$code, $name], false);
		return $return;
	}
	
	function DeleteStatus($ID){
		$return = $database->query("DELETE FROM `Status` WHERE `Status_Code` = ?", [$ID], false);
		return $return;
	}
	function GetAll(){
		global $database;
		$return = $database->query("SELECT * FROM Status");
		return $return;
	}
}