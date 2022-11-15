<?php 
class internal_user{
	private $User_ID;
	private $First_Name;
	private $Last_Name;
	private $Username;
	private $Password;
	private $Session_IP;
	private $User_Status;
	private $PROTECTED_USER_IDS = [];
	private $db;
	
	function __construct($database){
		$this->db = $database;
	}
	
	function FetchUser(){
		if(isset($_SESSION['user_uid'])){
			return $this->GetUserFromSession();
		}
		return false;
	}
	
	function GetUserFromID($id){
		$user_rows = $this->db->query("SELECT * FROM `Users` WHERE `User_ID` = ?", [$id]);
		if(count($user_rows) > 1){
			throw new Exception("Multiple users were found by a PK. This should not be possible!");
		}
		if(count($user_rows) == 0){
			return false;
		}
		foreach($user_rows[0] as $k=>$v){
			$this->$k = $v;
		}
		
		return(true);
	}
	
	function DoesUsernameExist($input){
		$users_found = $this->db->query("SELECT count(*) as count FROM `Users` WHERE `Username` = (?)", array($input));
		if($users_found[0]['count'] > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function TryLogin($username, $password){
		if($username == "" || $password == ""){
			return false;
		}
		$users_found = $this->db->query("SELECT User_ID, Username, Password FROM `Users` WHERE `Username` = ?", [$username]);
		foreach($users_found as $uf){
			if(password_verify($password, $uf['Password'])){
				$_SESSION['user_uid'] = $uf['User_ID'];
				// User successfully logged in.
				//Update Session IP
				return true;
			}
		}
		return false;
	}
	
	function CreateUser($username, $password, $first_name, $last_name){
		if(!($this->DoesUsernameExist($username))){
			$returns = $this->db->query('INSERT INTO `Users` (`First_Name`, `Last_Name`,  `Username`, `Password`) VALUES (?,?,?,?)', array($first_name, $last_name, $username, password_hash($password, PASSWORD_DEFAULT)), false);
			if($returns== 1){
				$_SESSION['user_uid'] = $this->db->query('SELECT User_ID FROM `Users` WHERE `Username` = ?', array($username), true)[0]['User_ID'];
				return true;
			}else{
				return false;
			}
		}else{
			throw new Exception("A user already exists with that username!");
		}
	}
	
	function GetUserFromSession(){
		$user_rows = $this->db->query("SELECT * FROM `Users` WHERE `User_ID` = ?", [$_SESSION['user_uid']]);
		if(count($user_rows) > 1){
			throw new Exception("Multiple users were found by a PK. This should not be possible!");
		}
		if(count($user_rows) == 0){
			return false;
		}
		foreach($user_rows[0] as $k=>$v){
			$this->$k = $v;
		}
		
		// check user session IP.  If not same invalidate session.
		
		return(true);
	}
	
	function DestroySession(){
		session_destroy();
	}
	
	function GetAttr($key){
		if(isset($this->$key)){
			return $this->$key;
		}
		return null;
	}
	
	function SetAttr($key, $value){
		if(property_exists($this, $key)){
			$this->db->query("UPDATE Users SET ".$key." = ? WHERE User_ID = ?", [ $value, $this->User_ID], false);
			$this->$key = $value;
		}
	}
	
	function CheckPermission($module, $permission){
		
		$permissions = Get_Global_Permissions();
		
		if(array_key_exists($module, $permissions)){
			if(!empty($permissions[$module][$permission])){
				if(strtolower($this->Username) == "administrator"){
					return true; // Global bypass for the user "administrator"
				}
				
				$group = new user_group($this->db, $this);
				$groups = $group->GetUserGroups();
				foreach($groups as $g){
					$this_group_perms = $group->GetGroupPermissions($g['Group_ID']);
					foreach($this_group_perms as $granted_perm){
						$granted_perm = $granted_perm["Permission"];
						if(strtoupper($granted_perm) == strtoupper($permissions[$module][$permission])){
							return true;
						}
					}
				}
			}
		}
		return false;
	}
	
	function GetUID(){
		return $this->User_ID;
	}
	
	function GetAllUsers_Minimal(){
		return $this->db->query("SELECT User_ID, First_Name, Last_Name, Username, Email FROM Users");
	}
}