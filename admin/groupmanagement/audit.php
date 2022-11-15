<?php
require("../../masterutil.php");
$pagename = "Group Management";
$group_controller = new user_group($database);
$groupperms = $group_controller->GetGroupPermissions($_GET['group']);
$granted_perms = [];
foreach($groupperms as $gp){
	$granted_perms[] = $gp['Permission'];
}
$permissions = Get_Global_Permissions();

if(!empty($_POST)){
	if(isset($_POST['Group_Name']) && $_POST['Group_Name'] != ""){
		if($group_controller->GetGroupName($_GET['group']) != $_POST['Group_Name']){
			$group_controller->UpdateGroupName($_GET['group'], $_POST['Group_Name']);
		}
	}
	foreach($permissions as $k=>$p){
		if(isset($_POST['permission_'.key($p)])){
//			// Group Should Have Perm
			if(!in_array($permissions[$k][key($p)], $granted_perms)){
				$group_controller->AddGroupPermission($_GET['group'],$permissions[$k][key($p)]);
				$group_change = true;
			}
		}else{
//			// User should not be in group
			if(in_array($permissions[$k][key($p)], $granted_perms)){
				$group_controller->RemoveGroupPermission($_GET['group'],$permissions[$k][key($p)]);
				$group_change = true;
			}
		}
	}
}
if(isset($group_change) && $group_change == true){
	$groupperms = $group_controller->GetGroupPermissions($_GET['group']);
	$granted_perms = [];
	foreach($groupperms as $gp){
		$granted_perms[] = $gp['Permission'];
	}
}
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<a href="index.php" class="btn btn-outline-danger">Go Back</a>
	<div class="col-12 mt-1">
		<div class="card">
	      <div class="card-header">
			Editing Group <?= $group_controller->GetGroupName($_GET['group']); ?>
		  </div>
		  <div class="card-body">
			<form action="" method="post">
				<div class="row">
					<div class="col-6 mb-2">
						Group Name
						<input type="text" name="Group_Name" class="form-control" value="<?= $group_controller->GetGroupName($_GET['group']) ?>">
					</div>
					<div class="col-6 mb-2">
					</div>
					<hr>
					<div class="col-6 mb-2 text-center">
						<span style="font-size: 115%">Permissions</span>
							<table id="permissions_table" class="table table-striped">
							<thead>
								<tr>
									<th>Module</th>
									<th>Permission</th>
									<th>Granted</th>
								</tr>
							</thead> 
							<tbody>

								<?php foreach($permissions as $module=>$permission){ 
								?>
								<tr>
									<td><?= $module ?></td>
									<td><?= key($permission) ?></td>
									<td><input name="permission_<?= key($permission) ?>" type="checkbox" <?= $me->CheckPermission($module, key($permission)) == true ? "" : "disabled"?>
											   <?= in_array($permissions[$module][key($permission)], $granted_perms) ? "checked" : ""?> ></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="col-6 mb-2 text-center">
						<span style="font-size: 115%">Users with group</span>
							<table id="user_table" class="table table-striped">
							<thead>
								<tr>
									<th>Username</th>
								</tr>
							</thead> 
							<tbody>

								<?php foreach($group_controller->GetUsersInGroup($_GET['group']) as $user){ 
								?>
								<tr>
									<td><?= $user['Username'] ?></td>
									
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<hr>
				<input type="submit" class="btn col-12 btn-outline-primary">
			</form>
		  </div>
		</div>
	</div>
</div>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>
<script>
$(document).ready( function () {
    $('#permissions_table').DataTable();
} );
$(document).ready( function () {
    $('#user_table').DataTable();
} );
</script>