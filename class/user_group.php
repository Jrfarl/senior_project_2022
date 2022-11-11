<?php
class user_group{
	private $db;
	private $User_ID = 0; // 0 should never exist in the database.
	private $Group_ID;
	private $PROTECTED_GROUP_IDS = [];
	
	#Pass in an internal_user object. Need to ensure that the 
	function __construct($database, $user=null){
		$this->db = $database;
		if(!is_null($user)){
			$this->user_id = $user->GetAttr("User_ID");
		}
	}
	
	function GetUserGroups(){ // User_ID MUST be set before this function call.
		# returns array
		return $this->db->query("SELECT * FROM Group_Users WHERE User_ID = ?", [$this->User_ID]);
	}
	
	function GetAllGroups(){
		return $this->db->query("SELECT * FROM Group_Reference");
	}
	
	function GetUsersInGroup($gid){
		return $this->db->query("SELECT DISTINCT * FROM Users WHERE User_ID in(SELECT User_ID From Group_Users WHERE Group_ID = ?", [$gid]);
	}
	
	function GetUsersInGroups($groups){
		if(!empty($groups)){
			return $this->db->query("SELECT DISTINCT * FROM Users WHERE User_ID in(SELECT User_ID From Group_Users WHERE Group_ID in(".implode(", ", $groups)."))");
		}
		return [];
	}
}