<?php
require("masterutil.php");
$pagename = "Dashboard";
$tickets = new ticket($database);
$unassigned = $tickets->GetUnassignedTickets();
$unassigned_count = count($unassigned);
$myTicket = $tickets->GetMyTickets($me->GetUID());
$myTicket_Count = count($myTicket);
$group_controller = new user_group($database, $me);
$mygroups = $group_controller->GetUserGroups();
$assigned_tickets = $tickets->GetAssignedTickets($me->GetUID(), $mygroups);
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
	<?php if($me->CheckPermission("ticket", "view_all")){ ?>
	<div class="col-6">
		<div class="card">
		  <div class="card-header">
			My Tickets
		  </div>
		  <div class="card-body">
			<h5 class="card-title">Open Tickets Assigned To Me | <?= count($assigned_tickets) ?> </h5>
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
			<h5 class="card-title">Current Tickets Not Assigned | <?= $unassigned_count ?></h5>
			<p class="card-text"></p>
		  </div>
		</div>
	</div>
    <?php }else{ ?>
		<div class="col-6">
		<div class="card">
		  <div class="card-header">
			My Tickets
		  </div>
		  <div class="card-body">
			<h5 class="card-title">Currently Owned Tickets | <?= $myTicket_Count ?> </h5>
			<p class="card-text"></p>
		  </div>
		</div>
	</div>
	<?php } ?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>