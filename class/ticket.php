<?php
class ticket{
	private $Ticket_ID;
	private $Title;
	private $Status_Code;
	private $Description;
	private $Assigned_To_User_ID  = [];
	private $Assigned_To_Group_ID  = [];
	private $Created_By_ID;
	private $Date_Created;
	private $Permissions = [];
	private $Metadata = [];
	private $Priority_Level;
	private $json_fields = ['Metadata', 'Permissions', 'Assigned_To_User_ID', 'Assigned_To_Group_ID'];
	private $db;
	
	function __construct($database, $target_id=null){
		$this->db = $database;
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
		$this->Title = $title;
		$this->Status_Code = 0;
		$this->Description = $description;
		$this->Date_Created = date("Y-m-d H-i");
		$this->Created_By_ID = $userobj->GetUID();
		
		$return = $this->db->query("INSERT INTO `Tickets` (Title, Status_Code, Description, Assigned_To_User_ID, Assigned_To_Group_ID , Created_By_ID, Metadata) VALUES (?,?,?,?,?,?,?)", [$this->Title, $this->Status_Code, $this->Description, json_encode($this->Assigned_To_User_ID),json_encode($this->Assigned_To_Group_ID),$this->Created_By_ID ,json_encode($this->Metadata)], false);
		if($return == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function UpdateTicketAttr($key, $value){
		if(property_exists($this, $key)){
			$return =$this->db->query("UPDATE `Tickets` SET `$key` = ? WHERE `Ticket_ID` = ?", [ $value, $this->Ticket_ID], false);
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
	
	function ArchiveTicket($tid){

		$this->db->query("INSERT INTO Archived_Tickets 
		(Ticket_ID, Title, Status_Code, Description, Assigned_To_User_ID, Assigned_To_Group_ID, Created_By_ID, Date_Created, Metadata, Priority_Level )
		 (SELECT Ticket_ID, Title, Status_Code, Description, Assigned_To_User_ID, Assigned_To_Group_ID, Created_By_ID, Date_Created, Metadata, Priority_Level
		  FROM Tickets WHERE Ticket_ID = ?
		)", [$tid], false);


		$comment = new comment($this->db);
		$comments = $comment->SelectAllByTicket($tid);

		foreach($comments as $c){
			$comment->ArchiveComment($c['Comment_ID']);

			$comment->DeleteComment($c['Comment_ID']);
		}
		
		$return = $this->db->query("DELETE FROM Tickets WHERE Ticket_ID = ?", [$tid], false);

		return ($return == 1);

	}
	
	function GetUnassignedTickets(){
		$return = $this->db->query("SELECT * FROM SeniorProject.Tickets WHERE Assigned_To_User_ID = '[]' AND Assigned_To_Group_ID = '[]'");
		return $return;
	}
	
	function GetAttr($key){
		if(isset($this->$key)){
			return $this->$key;
		}
		return null;
	}
	
	function UpdateAuditLog($user){
		$this->Metadata['Last_Audit_User'] = $user->GetUID();
		$this->Metadata['Last_Audit_Date'] = date("Y-m-d H-i");
		$return = $this->db->query("UPDATE `Tickets` SET Metadata = ? WHERE `Ticket_ID` = ?", [ json_encode($this->Metadata), $this->Ticket_ID], false);
		if($return == 1){
				return true;
			}else{
				return false;
			}
	}
	
	function GetPaginationNums($restrictions=null){
		if($restrictions == null){
			$returns = $this->db->query("SELECT count(*) as count FROM Tickets");
			return $returns;
		}
	}
	
}