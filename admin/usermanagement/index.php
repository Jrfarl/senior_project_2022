<?php
require("../../masterutil.php");
$pagename = "User Management";

if(!$me->CheckPermission("admin", "view_user_management")){
	header("Location: /dashboard.php");
}
$user = new internal_user($database);
$all_users_low_info = $user->GetAllUsers_Minimal();
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<div class="col-12">
		<div class="card">
		  <div class="card-body">
			<table id="user_table" class="table table-striped">
				<thead>
					<tr>
						<th>User ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
						<th>Email</th>
					</tr>
				</thead> 
				<tbody>
					
					<?php foreach($all_users_low_info as $u){ ?>
					<tr>
						<td><a href="audit.php?user=<?= $u['User_ID'] ?>"><?= $u['User_ID'] ?></a></td>
						<td><a href="audit.php?user=<?= $u['User_ID'] ?>"><?= $u['First_Name'] ?></a></td>
						<td><a href="audit.php?user=<?= $u['User_ID'] ?>"><?= $u['Last_Name'] ?></a></td>
						<td><a href="audit.php?user=<?= $u['User_ID'] ?>"><?= $u['Username'] ?></a></td>
						<td><a href="audit.php?user=<?= $u['User_ID'] ?>"><?= $u['Email'] ?></a></td>
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
    $('#user_table').DataTable();
} );
</script>