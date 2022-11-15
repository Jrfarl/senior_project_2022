<?php

require("../masterutil.php");

$pagename = "View Tickets";
$ticket_controller = new ticket($database);
$status_controller = new status($database);
$statuses = $status_controller->GetAll();
$group_controller = new user_group($database, $me);
$mygroups = $group_controller->GetUserGroups();
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<?php if($me->CheckPermission("ticket", "view_all")){ 
	$tickets = $ticket_controller->GetAllTickets();
?>
	<div class="col-12">
		<div class="col-12">
			<div class="card">
			  <div class="card-body">
				<table id="ticket_table" class="table table-striped">
					<thead>
						<tr>
							<th>Ticket ID</th>
							<th>Title</th>
							<th>Status</th>
							<th>Creator</th>
							<th>Priority</th>
						</tr>
					</thead> 
					<tbody>

						<?php foreach($tickets as $t){ ?>
						<tr>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Ticket_ID'] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Title'] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $statuses[$t['Status_Code']] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Created_By_ID'] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Priority_Level'] ?></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			  </div>
			</div>
		</div>
	</div>
<?php } else { 
$tickets = [];
$my_tickets = $ticket_controller->GetMyTickets($me->GetUID());
$group_tickets = $ticket_controller->GetAssignedTickets($me->GetUID(), $mygroups);
foreach($my_tickets as $mt){
	$tickets[] = $mt;
}
foreach($group_tickets as $gt){
	$tickets[] = $gt;
}
?>

	<div class="col-12">
		<div class="col-12">
			<div class="card">
			  <div class="card-body">
				<table id="ticket_table" class="table table-striped">
					<thead>
						<tr>
							<th>Ticket ID</th>
							<th>Title</th>
							<th>Status</th>
							<th>Creator</th>
							<th>Priority</th>
						</tr>
					</thead> 
					<tbody>

						<?php foreach($tickets as $t){ ?>
						<tr>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Ticket_ID'] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Title'] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $statuses[$t['Status_Code']] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Created_By_ID'] ?></a></td>
							<td><a href="audit.php?TID=<?= $t['Ticket_ID'] ?>"><?= $t['Priority_Level'] ?></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			  </div>
			</div>
		</div>
	</div>
<?php } ?>

<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>
<script>
$(document).ready( function () {
    $('#ticket_table').DataTable();
} );
</script>