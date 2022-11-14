<?php
require("masterutil.php");
if($me->CheckPermission("ticket", "create3")){
	echo("User has that permission");
}else{
	echo("User does not have that permission");
}