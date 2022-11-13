<?php
$protected_page = false;
require("masterutil.php");
$newUser = new internal_user($database);
if(!$newUser->FetchUser()){
	if(!empty($_POST)){
		$stop = false;
		if($_POST['password'] != $_POST['password_confirm']){
			$error[] = "Passwords do not match!";
			$stop = true;
		}
		// Setup password length requirements and other requirements.
		
		if(!isset($_POST['username']) || !isset($_POST['password']) ||
			 !isset($_POST['fname']) || !isset($_POST['lname']) ||
			 $_POST['username'] == "" || $_POST['password'] == "" || 
			 $_POST['fname'] == "" || $_POST['lname'] = ""){
				$error[] = "Please fill in all fields";
				$stop = true;
			 }

		if($newUser->DoesUsernameExist($_POST['username'])){
			$error[] = "That username is already taken!";
			$stop = true;
		}
		
		if(!$stop){
			if($newUser->CreateUser($_POST['username'], $_POST['password'], $_POST['fname'], $_POST['lname'])){
				// Creation Successful, 
				header("Location: dashboard.php");
			}else{
				$error[] = "An unknown mysqli error has occured.";
			}
		}
	}
}else{
	header("Location: dashboard.php");
	// User is logged in. Redirect here.
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= $sitename ?> | Register</title>
<link href="<?= $CONST_VENDORDIR?>/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="password" name="password_confirm" placeholder="Confirm Password">
		<input type="text" name="fname" placeholder="First Name">
		<input type="text" name="lname" placeholder="Last Name">
		<input type="submit" placeholder="Register" class="btn btn-outline-primary">
	</form>
</body>
</html>
<script src="<?= $CONST_VENDORDIR?>/twbs/bootstrap/dist/js/bootstrap.min.js"></script>