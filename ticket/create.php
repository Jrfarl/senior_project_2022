<?php
require("../masterutil.php");
$pagename = "Create Ticket";
?>
<?php require("../templates/base_logged_in_top.php"); ?>
<div class="col-12">
	<div class="col-12">
		<div class="card">
		  <div class="card-header">
			Create Ticket
		  </div>
		  <div class="card-body">
			<h5 class="card-title">Create a Ticket</h5>
			<p class="card-text">
				<div class="form">
			  		<div class="row">
						<div class="col-6">
							<input class="form-control" placeholder="Title" name="Title">
						</div>
						<div class="col-6">
							<input class="form-control" placeholder="Department" name="Department">
						</div>
						<div class="col-12 mt-2">
							<textarea class="form-control" name="Narrative" rows="7" placeholder="Explain in as much detail as possible the reason for the ticket"></textarea>
						</div>
					</div>
			  	</div>  
			</p>
		  </div>
		</div>
	</div>
</div>
<?php require("../templates/base_logged_in_bottom.php"); ?>