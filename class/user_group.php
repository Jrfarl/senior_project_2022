<?php
class user_group{
	private $User_ID = 0; // 0 should never exist in the database.
	private $Group_ID;
	
	#Pass in an internal_user object. Need to ensure that the 
	function __construct($user=null){
		if(!is_null($user)){
			global $database;
			$this->user_id = $user->GetAttr("User_ID");
		}
	}
	
	function GetUserGroups(){ // User_ID MUST be set before this function call.
		# returns array
		global $database;
		return $database->query("SELECT * FROM Group_Users WHERE User_ID = ?", [$this->User_ID]);
	}
}