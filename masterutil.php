<?php
$debug = true;
if($debug){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}
if(session_status() === PHP_SESSION_NONE){
	session_start();
}

require("class/autoload.php");
require("masterconfig.php"); // Can throw unhandled exception if file is not found. This will NOT be changed and be considered as a fatal error.



// User login check. 
#  Being this page is included on ALL PAGES this code below should work fine. 
#  To bypass a login check for a public page all you need to do is put $protected_page ABOVE the include for this file.
#  Ex:
#         $protected_page = false;
#         require("masterutil.php");

if(!isset($protected_page) || $protected_page != false){  
	$me = new internal_user($database);
	if(!$me->GetUserFromSession()){
		header("Location: /login.php");
	}
}

$config = new config($database);

$CONST_SITENAME = $config->GetValue("SITE_NAME");

function Get_Global_Permissions(){
	$permissions = [];
	$permissions['core']['log_in'] = "CORE_LOG_IN";
	$permissions['ticket']['create'] = "TICKET_CREATE";
	$permissions['admin']['view_admin_area'] = "VIEW_ADMIN_AREA";
//	$permissions['ticket']['modify'];
//	$permissions['ticket']['delete'];
//	$permissions['ticket']['comment'];
//	$permissions['ticket']['archive'];
	return $permissions;
}

