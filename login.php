<?php 
$protected_page = false;
require("masterutil.php");
if(isset($_SESSION['user_uid'])){
	header("Location: dashboard.php");
	// Forward to dashboard or other page after login
}else{
	if(!empty($_POST)){ // All user login requests will be handled over POST. GET is not supported due to security vulnerabilities. 
		if(!isset($_POST['username']) || $_POST['username'] == ""){
			$error[] = "Please insert a username";
		}
		if(!isset($_POST['password']) || $_POST['password'] == ""){
			$error[] = "Please insert a password";
		}
		$CheckUser = new internal_user();
		if($CheckUser->TryLogin($_POST['username'], $_POST['password'])){
			header("Location: dashboard.php");
		}else{
			$error[] = "Invalid username or password";
		}
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= $sitename ?> | Login</title>
<link href="<?= $CONST_VENDORDIR?>/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= $assets?>/css/loginsys.css">
</head>

<body>
	<?php if(!empty($error)){?>
	<div class="alert alert-danger" role="alert">
	 <?php foreach($error as $k=>$e){
			if(count($error) > $k){
				echo($e."<br>");
			}else{
				echo($e);
			}
		}?>
	</div>
	<?php } ?>
	<?php if(!empty($warn)){?>
	<div class="alert alert-warm" role="alert">
	 <?php foreach($warn as $k=>$e){
			if(count($warn) > $k){
				echo($e."<br>");
			}else{
				echo($e);
			}
		}?>
	</div>
	<?php } ?>
		<?php if(!empty($success)){?>
	<div class="alert alert-warm" role="alert">
	 <?php foreach($success as $k=>$e){
			if(count($success) > $k){
				echo($e."<br>");
			}else{
				echo($e);
			}
		}?>
	</div>
	<?php } ?>
	<form action="" method="post">
		<input name="username" type="text" placeholder="Username">
		<input name="password" type="password" placeholder="Password">
		<input type="submit" value="LOGIN" class="btn btn-outline-primary">
	</form>
	<a href="register.php" class="btn btn-outline-success">Register</a>
</body>
</html>
<script src="<?= $CONST_VENDORDIR?>/twbs/bootstrap/dist/js/bootstrap.min.js"></script>