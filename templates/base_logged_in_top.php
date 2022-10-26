<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= $sitename ?> | <?= isset($pagename) ? $pagename : "" ?></title>
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