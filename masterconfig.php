<?php
############################################
#			   Database Init			   #
############################################
$database = new database("localhost", "sys_core", "K~;oBGpIXa5YDAu", "SeniorProject");

############################################
#			Global Variable Init		   #
############################################
$error = [];
$success = [];
$warn = [];

$CONST_VENDORDIR = "/vendor";
$CONST_APIDIR =  __dir__."/api";
$CONST_ASSETDIR =  __dir__."/assets";
$CONST_TEMPLATEDIR = __dir__."/templates";

$me; // set up global user variable. can be called from any file being this variable is initalized in this file which has a high priority.


