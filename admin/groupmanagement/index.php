<?php
require("../../masterutil.php");
$pagename = "Group Management";

$group = new user_group($database);
$groups = $group->GetAllGroups();
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<div class="col-12">
		<div class="card">
		  <div class="card-body">
			  <div class="row mb-2">
			  	<div class="col-6">
					<a href="create.php" class="btn btn-outline-primary">Create New Group</a>
				  </div>
			  </div>
			<table id="group_table" class="table table-striped">
				<thead>
					<tr>
						<th>Group ID</th>
						<th>Group Name</th>
						
					</tr>
				</thead> 
				<tbody>
					
					<?php foreach($groups as $g){ ?>
					<tr>
						<td><a href="audit.php?group=<?= $g['Group_ID'] ?>"><?= $g['Group_ID'] ?></a></td>
						<td><a href="audit.php?group=<?= $g['Group_ID'] ?>"><?= $g['Group_Name'] ?></a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		  </div>
		</div>
	</div>
</div>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>
<script>
$(document).ready( function () {
    $('#group_table').DataTable();
} );
</script>