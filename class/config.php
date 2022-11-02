<?php 
class config{
	private $kvp = [];
	
	function __construct(){
		global $database;
		$returns = $database->query("SELECT `Key`, `Value` FROM `Config`");
		foreach($returns as $r){
			$this->kvp[$r['Key']] = $r['Value'];
		}
	}
	
	function GetValue($input){
		if(array_key_exists($input, $this->kvp)){
			return $this->kvp[$input];
		}
		return null;
	}
	
	function SetKVP($key, $value){
		global $database;
		if(!array_key_exists($key, $this->kvp)){
			//Insert statement	
			$returns = $database->query('INSERT INTO `Config` (`Key`, `Value`  ) VALUES (?,?)', array($key, $value), false);
			if($returns== 1){
				$this->kvp[$key] = $value;
				return true;
			}else{
				return false;
			}
		}else{
			//update statement
			$returns = $database->query('UPDATE `Config` SET `Value` = ? WHERE `Key` = ?', array($value, $key), false);
			if($returns== 1){
				$this->kvp[$key] = $value;
				return true;
			}else{
				return false;
			}
		}
	}
	
	function DeleteKey($input){
		global $database;
		
		unset($this->kvp[$input]);
		$this->kvp[$input] = null;
	}
	
}