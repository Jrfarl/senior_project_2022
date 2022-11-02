<?php 
class internal_user{
	private $User_ID;
	private $First_Name;
	private $Last_Name;
	private $Username;
	private $Password;
	private $Session_IP;
	private $PROTECTED_USER_IDS = [];
	
	function FetchUser(){
		if(isset($_SESSION['user_uid'])){
			return $this->GetUserFromSession();
		}
		return false;
	}
	
	function DoesUsernameExist($input){
		global $database;
		$users_found = $database->query("SELECT count(*) as count FROM `Users` WHERE `Username` = (?)", array($input));
		if($users_found[0]['count'] > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function TryLogin($username, $password){
		global $database;
		if($username == "" || $password == ""){
			return false;
		}
		$users_found = $database->query("SELECT User_ID, Username, Password FROM `Users` WHERE `Username` = ?", [$username]);
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
		global $database;
		if(!($this->DoesUsernameExist($username))){
			$returns = $database->query('INSERT INTO `Users` (`First_Name`, `Last_Name`,  `Username`, `Password`) VALUES (?,?,?,?)', array($first_name, $last_name, $username, password_hash($password, PASSWORD_DEFAULT)), false);
			if($returns== 1){
				$_SESSION['user_uid'] = $database->query('SELECT User_ID FROM `Users` WHERE `Username` = ?', array($username), true)[0]['User_ID'];
				return true;
			}else{
				return false;
			}
		}else{
			throw new Exception("A user already exists with that username!");
		}
	}
	
	function GetUserFromSession(){
		global $database;
		$user_rows = $database->query("SELECT * FROM `Users` WHERE `User_ID` = ?", [$_SESSION['user_uid']]);
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
	
	function CheckPermission($permission){
		
	}
	
	function GetUID(){
		return $this->User_ID;
	}
}