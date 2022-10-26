<?php
class ticket{
	private $Ticket_ID;
	private $Title;
	private $Status_Code;
	private $Assigned_To_ID;
	private $Created_By_ID;
	private $Date_Created;
	private $metadata = [];
	
	function __construct($target_id=null){
		if(!is_null($target_id)){
			// Get Ticket From ID
			global $database;
			$returns = $database->query("SELECT * FROM `Tickets` WHERE `Ticket_ID` = ?", [$target_id]);
			foreach($returns[0] as $r){
				$this->kvp[$r['Key']] = $r['Value'];
			}
		}
	}
	
	function CreateTicket($title, $status, $description, $assigned_to, $created_by){
		$return = $database->query("INSERT INTO `Tickets` (Title, Status_Code, Description, Assigned_To_ID, Create_By_ID, Metadata)", [$title, $status, $description, $assigned_to, $created_by], false);
		if($return == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function UpdateTicketAttr($key, $value){
		$return = $database->query("UPDATE `Tickets` SET ? = ? WHERE `Ticket_ID` = ?", [$key, $value, $this->Ticket_ID], false);
		if($return == 1){
			$this->$key = $value;
			return true;
		}else{
			return false;
		}
	}
	
	function ArchiveTicket(){
		// Archive Ticket Here
	}
}