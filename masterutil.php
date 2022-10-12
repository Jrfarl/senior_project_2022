<?php
$debug = true;
if($debug){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

require("class/autoload.php");
require("masterconfig.php"); // Can throw unhandled exception if file is not found. This will NOT be changed and be considered as a fatal error.

