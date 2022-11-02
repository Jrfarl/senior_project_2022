<?php
require("../masterutil.php");
$pagename = "Create Ticket";
$stop = false;
if(!empty($_POST)){
	if(!isset($_POST['title']) || $_POST['title'] == ''){
		$error[] = "You must include a title!";
		$stop = true;
	}
		if(!isset($_POST['narrative']) || $_POST['narrative'] == ''){
		$error[] = "You must include a description!";
		$stop = true;
	}
	if(!$stop){
		$ticket = new ticket();
		$return = $ticket->CreateTicket($_POST['title'], $_POST['narrative'], $me);
		if($return == true){
			header("Location: ".$_SERVER['PHP_SELF']."?success");
		}
	}
}
if(isset($_GET['success'])){
	$success[] = "Your ticket has been created successfully!";
}
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<div class="col-12">
		<div class="card">
		  <div class="card-header">
			Create Ticket
		  </div>
		  <div class="card-body">
			<p class="card-text">
				<div class="form">
					<form action="" method="post">
			  		<div class="row mb-1">
						<div class="col-6">
							<input class="form-control" placeholder="Title" name="title">
						</div>
						<div class="col-12 mt-2">
							<textarea class="form-control" name="narrative" rows="15" placeholder="Explain in as much detail as possible the reason for the ticket"></textarea>
						</div>
					</div>
					<div class="col-12">
						<input type="submit" class="btn btn-outline-primary col-12">
					</div>
					</form>
			  	</div>  
			</p>
		  </div>
		</div>
	</div>
</div>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>