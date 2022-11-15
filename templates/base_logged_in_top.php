<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= $CONST_SITENAME ?> | <?= isset($pagename) ? $pagename : "" ?></title>
<link href="<?= $CONST_VENDORDIR?>/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= $CONST_VENDORDIR?>/datatables/jquery_datatables_min.css" rel="stylesheet">
</head>
	
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard.php"><?= $CONST_SITENAME ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/dashboard.php">Home</a>
        </li>
		   <?php if($me->CheckPermission("ticket", "create")){ ?>
        <li class="nav-item">
          <a class="nav-link" href="/ticket/create.php">Create Ticket</a>
        </li>
		  <?php } ?>
		<li class="nav-item">
          <a class="nav-link" href="/ticket/list.php">View Tickets</a>
        </li>
		  <?php if($me->CheckPermission("admin", "view_admin_area")){ ?>
		<li class="nav-item">
          <a class="nav-link" href="/admin/index.php">Administrator</a>
        </li>
		  <?php } ?>
		  
		  

      </ul>
	<a class="btn btn-outline-danger" href="/logout.php">Log Out</a>
    </div>
  </div>
</nav>
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
	<div class="alert alert-warn" role="alert">
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
	<div class="alert alert-success" role="alert">
	 <?php foreach($success as $k=>$e){
			if(count($success) > $k){
				echo($e."<br>");
			}else{
				echo($e);
			}
		}?>
	</div>
	<?php } ?>
	<div class="col-12">
		<div class="row mx-2 mt-2">