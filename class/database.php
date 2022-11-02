<?php
class database{
	private $dbconn;

	function __construct($ip, $user, $password, $database, $port=3306 ){
		global $debug;
		try{
			$this->dbconn = new \MySQLi($ip, $user, $password, $database , $port );
			if($debug){
				mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			}
		}catch(Exception $e){
			die(print_r($e));
		}
	}

	function query($query,  $params = [], $return_values=true){
		try{
			$thisquery = $this->dbconn->prepare($query);
			if($thisquery === false){
				throw new Exception("Could not prepare mysqli query!");
			}
			if(!empty($params)){
				
				$thisquery->bind_param(str_repeat('s', count($params)), ...$params);
			}
			$response = $thisquery->execute();
			if($return_values){

			$return = $thisquery->get_result()->fetch_all(MYSQLI_ASSOC);
			}else{
				$return = $response;
			}

			return $return;
		}catch( Exception $e ){
			throw new Exception(print_r($e));
		}
	}
}
