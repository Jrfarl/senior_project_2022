<?php
require("../masterutil.php");
$pagename = "Create Ticket";
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
			  		<div class="row">
						<div class="col-6">
							<input class="form-control" placeholder="Title" name="title">
						</div>
						<div class="col-12 mt-2">
							<textarea class="form-control" name="narrative" rows="15" placeholder="Explain in as much detail as possible the reason for the ticket"></textarea>
						</div>
					</div>
			  	</div>  
			</p>
		  </div>
		</div>
	</div>
</div>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>