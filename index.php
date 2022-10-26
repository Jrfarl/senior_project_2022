<?php
require("masterutil.php");
$newUser = new internal_user();
if(!$newUser->FetchUser()){
	header("Location: login.php");
	exit();
}
header("Location: dashboard.php");