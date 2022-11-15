<?php 
$protected_page = false;
require("masterutil.php");

$pagename = "login";

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
		$CheckUser = new internal_user($database);
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
<title><?= $CONST_SITENAME ?> | <?= isset($pagename) ? $pagename : "" ?></title>
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
	<div class="row align-items-center g-lg-5 py-5">
    
    <div class ="col-md-10 mx-auto col-lg-5">
    
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="" method="post">
      <h3 class="text-center">Please Sign In or Register a New Account</h3>
          <div class="form-floating mb-3">
              <input class="form-control" name="username" type="text" placeholder="Username">
              <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
              <input class="form-control" name="password" type="password" placeholder="Password">
              <label for="password">Password</label>
          </div>
          <div class="container ">
            <div class = "row">
              <input type="submit" value="LOGIN" class="btn btn-outline-primary col">
              <h4 class="col-md-auto">or</h4>
              <a href="register.php" class="btn btn-outline-success col">Register</a>
            </div>
          </div>
      </form>
    </div>
    </div>
</body>
</html>
<script src="<?= $CONST_VENDORDIR?>/twbs/bootstrap/dist/js/bootstrap.min.js"></script>