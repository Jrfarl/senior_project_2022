<?php
require("masterutil.php");
$pagename = "Dashboard";
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
	
	<div class="col-6">
		<div class="card">
		  <div class="card-header">
			My Tickets
		  </div>
		  <div class="card-body">
			<h5 class="card-title">Open Tickets Assigned To Me <?php $me->FetchUser();?></h5>
			<p class="card-text"></p>
		  </div>
		</div>
	</div>
	<div class="col-6">
		<div class="card">
		  <div class="card-header">
			Unassigned Tickets
		  </div>
		  <div class="card-body">
			<h5 class="card-title">Current Tickets Not Assigned </h5>
			<p class="card-text"></p>
		  </div>
		</div>
	</div>

<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>