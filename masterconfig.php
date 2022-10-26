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
$CONST_APIDIR =  "/api";
$CONST_ASSETDIR =  "/assets";
$CONST_TEMPLATEDIR = "/templates";

$me;


