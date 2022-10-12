<?php 
class internal_user{
	private $User_ID;
	private $First_Name;
	private $Last_Name;
	private $Username;
	private $Password;
	private $Session_IP;
	
	function FetchUser(){
		if(isset($_SESSION['user_uid'])){
			return $this->GetUserFromSession();
		}
		return false;
	}
	
	function TryLogin($username, $password){
		if($username == "" || $password == ""){
			return false;
		}
		$users_found = $database->query("SELECT * FROM `Users` WHERE `Login_ID` = '?'", [$username]);
		foreach($users_found as $uf){
			if(password_verify($password, $uf['Password'])){
				// User successfully logged in.
				//Update Session IP
				return true;
			}
		}
		return false;
	}
	
	function CreateUser($username, $password, $first_name, $last_name, $groups){
		$returns = $database->query('INSERT INTO `Users` (`First_Name`, `Last_Name`, `Groups`, `Login_id`, `Password`) VALUES (?,?,?,?,?)', $first_name, $last_name, $groups, $username, password_hash($password));
		if($returns->affected_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function GetUserFromSession(){
		$user_rows = $database->query("SELECT * FROM `Users` WHERE `user_id` = '?'", [$_SESSION['user_uid']]);
		if(count($user_rows) > 1){
			throw new Exception("Multiple users were found by a PK. This should not be possible!");
		}
		if(count($user_rows) == 0){
			return false;
		}
		foreach($user_rows as $k=>$v){
			$this[$k] = $v;
		}
		
		// check user session IP.  If not same invalidate session.
		
		return(true);
	}
	
	function DeleteSession($session_id){
		throw new Exception("DeleteSession Functionality has not been implemented!");
	}
}