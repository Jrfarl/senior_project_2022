<?php

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

if($config->GetValue("CORE_DEBUG_ACTIVE")){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

$CONST_SITENAME = $config->GetValue("SITE_NAME");

function Get_Global_Permissions(){
	$permissions = [];
	$permissions['core']['log_in'] = "CORE_LOG_IN";
	$permissions['ticket']['create'] = "CREATE_TICKET";
	$permissions['ticket']['view_all'] = "VIEW_ALL_TICKETS";
	$permissions['ticket']['archive'] = "ARCHIVE_TICKET";
	$permissions['ticket']['view_ticket_comments'] = "VIEW_TICKET_COMMENTS";
	$permissions['ticket']['create_ticket_comment'] = "CREATE_TICKET_COMMENT";
	$permissions['ticket']['change_ticket_priority'] = "CHANGE_TICKET_PRIORITY";
	$permissions['ticket']['change_ticket_status'] = "CHANGE_TICKET_STATUS";
	$permissions['ticket']['change_ticket_groups'] = "CHANGE_TICKET_GROUPS";
	$permissions['ticket']['change_ticket_users'] = "CHANGE_TICKET_USERS";
	$permissions['ticket']['change_ticket_title'] = "CHANGE_TICKET_TITLE";
	$permissions['admin']['view_admin_area'] = "VIEW_ADMIN_AREA";
	$permissions['admin']['view_user_management'] = "VIEW_USER_MANAGEMENT";
	$permissions['admin']['view_group_management'] = "VIEW_GROUP_MANAGEMENT";
	$permissions['admin']['view_site_settings'] = "VIEW_SITE_SETTINGS";
	$permissions['admin']['edit_user_username'] = "EDIT_USER_USERNAME";
	$permissions['admin']['edit_user_name'] = "EDIT_USER_NAME";
	$permissions['admin']['edit_user_status'] = "EDIT_USER_STATUS";
	$permissions['admin']['edit_user_groups'] = "EDIT_USER_GROUPS";
	$permissions['admin']['create_new_group'] = "CREATE_NEW_GROUP";
	$permissions['admin']['edit_group_name'] = "EDIT_GROUP_NAME";
	$permissions['admin']['edit_group_permissions'] = "EDIT_GROUP_PERMISSIONS";
	return $permissions;
}

