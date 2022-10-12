<?php 
class internal_user{
	private $userid;
	private $fname;
	private $lname;
	private $gids = [];
	private $session_id;
	private $password;
	
	function CheckForUserSession(){
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
	}
}