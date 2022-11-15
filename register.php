<?php
$protected_page = false;
require("masterutil.php");

$pagename="Register";

$newUser = new internal_user($database);
$group_controller = new user_group($database);
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
			 $_POST['fname'] == "" || $_POST['lname'] == ""){
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
				$group_controller->AddUserToGroup($newUser->GetUID(), 1);
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
<title><?= $CONST_SITENAME ?> | <?= isset($pagename) ? $pagename : "" ?></title>
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
	<div class="row align-items-center g-lg-5 py-5">
    
    <div class ="col-md-10 mx-auto col-lg-5">
    
	<form class="p-4 border rounded-3 bg-light" action="" method="post">
      <h3 class="text-center">Register</h3>
      	<div class="form-floating mb-3">
			<input class="form-control" type="text" name="username" placeholder="Username">
			<label for="username">Username</label>
        </div>
        <div class="form-floating mb-3">
			<input class="form-control" type="password" name="password" placeholder="Password">
			<label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
			<input class="form-control" type="password" name="password_confirm" placeholder="Confirm Password">
			<label for="password_confirm">Confirm Password</label>
        </div>
        <div class="form-floating mb-3">
			<input class="form-control" type="text" name="fname" placeholder="First Name">
			<label for="fname">First Name</label>
        </div>
        <div class="form-floating mb-3">
			<input class="form-control" type="text" name="lname" placeholder="Last Name">
			<label for="fname">Last Name</label>
        </div>
        <div class="row">
			<input type="submit" placeholder="Register" class="btn btn-outline-primary ">
        </div>
	</form>
    </div>
    </div>
</body>
</html>
<script src="<?= $CONST_VENDORDIR?>/twbs/bootstrap/dist/js/bootstrap.min.js"></script>