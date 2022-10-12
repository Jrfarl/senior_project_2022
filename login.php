<?php 
require("masterutil.php");
if(isset($_SESSION['user_uid'])){
	// Forward to dashboard or other page after login
}else{
	if(!empty($_POST)){ // All user login requests will be handled over POST. GET is not supported due to security vulnerabilities. 
		
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= $sitename ?> | Login</title>
<link href="<?= $vendordir?>/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= $assets?>/css/loginsys.css">
</head>

<body>
	<form action="" method="post">
		<input name="username" type="text" placeholder="Username">
		<input name="password" type="password" placeholder="Password">
		<input type="submit" value="LOGIN" class="btn btn-outline-primary">
	</form>
	<a href="register.php" class="btn btn-outline-success">Register</a>
</body>
</html>
<script src="<?= $vendordir?>/twbs/bootstrap/dist/js/bootstrap.min.js"></script>