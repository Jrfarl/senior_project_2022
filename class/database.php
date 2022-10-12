<?php
class database{
	private $dbconn;

	function __construct($ip, $user, $password, $database, $port=3306 ){
		try{
			$this->dbconn = new \MySQLi($ip, $user, $password, $database , $port );
		}catch(Exception $e){
			die(print_r($e));
		}
	}

	function query($query, $params = [], $return_values=true){
		try{
			$thisquery = $this->dbconn->prepare($query);
			
			if($thisquery === false){
				throw new Exception("Could not prepare mysqli query!");
			}
			
			if(!empty($params)){
				call_user_func_array(array($thisquery, 'bind_param'), $params);
			}
			
			$thisquery->execute();
			return $thisquery;
		}catch( Exception $e ){
			throw new Exception(print_r($e));
		}
	}
}
