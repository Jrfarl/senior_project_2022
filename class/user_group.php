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
			$this->User_ID = $user->GetAttr("User_ID");
		}
	}
	
	function GetUserGroups(){ // User_ID MUST be set before this function call.
		# returns array
		return $this->db->query("SELECT * FROM Group_Users WHERE User_ID = ?", [$this->User_ID]);
	}
	
	function GetAllGroups(){
		return $this->db->query("SELECT * FROM Group_Reference");
	}
	
	function CreateGroup($name){
		$check = $this->db->query("SELECT * FROM Group_Reference WHERE Group_Name = ?", [$name]);
		if(empty($check)){
			$this->db->query("INSERT INTO Group_Reference (Group_Name) VALUES (?)", [$name], false);
			$return = $this->db->query("SELECT * FROM Group_Reference WHERE Group_Name = ?", [$name]);
			return $return[0]['Group_ID'];
		}else{
			return false;
		}
	}
	
	function GetUsersInGroup($gid){
		return $this->db->query("SELECT DISTINCT * FROM Users WHERE User_ID in(SELECT User_ID From Group_Users WHERE Group_ID = ?)", [$gid]);
	}
	
	function GetUsersInGroups($groups){
		if(!empty($groups)){
			return $this->db->query("SELECT DISTINCT * FROM Users WHERE User_ID in(SELECT User_ID From Group_Users WHERE Group_ID in(".implode(", ", $groups)."))");
		}
		return [];
	}
	
	function GetGroupName($gid){
		$group= $this->db->query("SELECT * FROM Group_Reference WHERE Group_ID = ?", [$gid]);
		return $group[0]['Group_Name'];
	}
	
	function GetGroupPermissions($gid){
		return $this->db->query("SELECT * FROM Group_Permissions WHERE Group_ID = ?", [$gid]);
	}
	
	function AddGroupPermission($groupid, $permission){
		return $this->db->query("INSERT INTO Group_Permissions (Group_ID, Permission) VALUES (?,?)", [$groupid, $permission], false);	
	}
	
	function RemoveGroupPermission($groupid, $permission){
		return $this->db->query("DELETE FROM Group_Permissions WHERE Group_ID = ? AND Permission = ?", [$groupid, $permission], false);	
	}
	
	function AddUserToGroup($userid, $groupid){
		return $this->db->query("INSERT INTO Group_Users (User_ID, Group_ID) VALUES (?,?)", [$userid, $groupid], false);	
	}
	
	function RemoveUserFromGroup($userid, $groupid){
		return $this->db->query("DELETE FROM Group_Users WHERE User_ID = ? AND Group_ID = ?", [$userid, $groupid], false);
	}
	
	function UpdateGroupName($gid, $name){
		return $this->db->query("Update Group_Reference SET Group_Name = ? WHERE Group_ID = ?", [$name, $gid], false);
	}
}