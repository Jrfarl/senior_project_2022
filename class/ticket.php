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
	private $Metadata = [];
	private $Priority_Level;
	private $json_fields = ['Metadata', 'Permissions', 'Assigned_To_ID'];
	
	function __construct($target_id=null){
		if(!is_null($target_id)){
			// Get Ticket From ID
			global $database;
			$returns = $database->query("SELECT * FROM `Tickets` WHERE `Ticket_ID` = ?", [$target_id]);
			foreach($returns[0] as $k=>$r){
				if(!in_array($k, $this->json_fields)){
					$this->$k = $r;
				}else{
					$this->$k = json_decode($r, true);
				}
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
		
		$return = $database->query("INSERT INTO `Tickets` (Title, Status_Code, Description, Assigned_To_ID, Created_By_ID, Metadata) VALUES (?,?,?,?,?,?)", [$this->Title, $this->Status_Code, $this->Description, json_encode($this->Assigned_To_ID),$this->Created_By_ID ,json_encode($this->Metadata)], false);
		if($return == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function UpdateTicketAttr($key, $value){
		global $database;
		if(property_exists($this, $key)){
			$return = $database->query("UPDATE `Tickets` SET `$key` = ? WHERE `Ticket_ID` = ?", [ $value, $this->Ticket_ID], false);
			if($return == 1){
				if(is_array($this->$key)){
					$this->$key = json_decode($value, true);
				}else{
					$this->$key = $value;
				}
				
				return true;
			}else{
				echo("Returning false");
				return false;
			}
		}
		echo("Returning null");
	}
	
	function ArchiveTicket(){
		// Archive Ticket Here
	}
	
	function GetUnassignedTickets(){
		global $database;
		$return = $database->query("SELECT * FROM SeniorProject.Tickets WHERE Assigned_To_ID = '[]'");
		return $return;
	}
	
	function GetAttr($key){
		if(isset($this->$key)){
			return $this->$key;
		}
		return null;
	}
	
	function UpdateAuditLog($user){
		global $database;
		$this->Metadata['Last_Audit_User'] = $user->GetUID();
		$this->Metadata['Last_Audit_Date'] = date("Y-m-d H-i");
		$return = $database->query("UPDATE `Tickets` SET Metadata = ? WHERE `Ticket_ID` = ?", [ json_encode($this->Metadata), $this->Ticket_ID], false);
		if($return == 1){
				return true;
			}else{
				return false;
			}
	}
	
	function getPaginationNums($restrictions=null){
		global $database;
		if($restrictions == null){
			$returns = $database->query("SELECT count(*) FROM Tickets");
			return $returns;
		}
	}
	
}