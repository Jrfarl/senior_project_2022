<?php
class ticket{
	private $Ticket_ID;
	private $Title;
	private $Status_Code;
	private $Description;
	private $Assigned_To_ID = [];
	private $Created_By_ID;
	private $Date_Created;
	private $Permissions = [];
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
	
	function CreateTicket($title, $description, $userobj){
		global $database;
		$this->Title = $title;
		$this->Status_Code = 0;
		$this->Description = $description;
		$this->Date_Created = date("Y-m-d H-i");
		$this->Created_By_ID = $userobj->GetUID();
		
		$return = $database->query("INSERT INTO `Tickets` (Title, Status_Code, Description, Assigned_To_ID, Created_By_ID, Metadata) VALUES (?,?,?,?,?,?)", [$this->Title, $this->Status_Code, $this->Description, json_encode($this->Assigned_To_ID),$this->Created_By_ID ,json_encode($this->metadata)], false);
		if($return == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function UpdateTicketAttr($key, $value){
		global $database;
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
	
	function GetUnassignedTickets(){
		global $database;
		$return = $database->query("SELECT * FROM SeniorProject.Tickets WHERE Assigned_To_ID = '[]'");
		return $return;
	}
}