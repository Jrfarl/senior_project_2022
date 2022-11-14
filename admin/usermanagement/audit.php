<?php
require("../../masterutil.php");
$pagename = "User Management";

$user = new internal_user($database);
$user->GetUserFromID($_GET['user']);
$group_controller = new user_group($database, $user);
$all_groups = $group_controller->GetAllGroups();
$my_groups_external = $group_controller->GetUserGroups();
$my_groups_internal = [];
foreach($my_groups_external as $mg){
	$my_groups_internal[$mg['Group_ID']] = true;
}

if(!empty($_POST)){
	$group_change = false;
	foreach($_POST as $k=>$v){
		if(!preg_match('/group_[0-9]/', $k)){
			if($user->GetAttr($k) != $v){
				$user->SetAttr($k, $v);
			}
		}
	}
	foreach($all_groups as $ag){
		if(isset($_POST['group_'.$ag['Group_ID']])){
			// User should be in group
			if(!isset($my_groups_internal[$ag['Group_ID']])){
				$group_controller->AddUserToGroup($_GET['user'],$ag['Group_ID']);
				$group_change = true;
			}
		}else{
			// User should not be in group
			if(isset($my_groups_internal[$ag['Group_ID']])){
				$group_controller->RemoveUserFromGroup($_GET['user'],$ag['Group_ID']);
				$group_change = true;
			}
		}
	}
	if($group_change){
		$my_groups_external = $group_controller->GetUserGroups();
		$my_groups_internal = [];
		foreach($my_groups_external as $mg){
			$my_groups_internal[$mg['Group_ID']] = true;
		}
	}
}
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<a href="index.php" class="btn btn-outline-danger">Go Back</a>
	<div class="col-12 mt-1">
		<div class="card">
	      <div class="card-header">
			Editing User <?= $user->GetAttr("Username"); ?>
		  </div>
		  <div class="card-body">
			<form action="" method="post">
				<div class="row">
					<div class="col-6 mb-2">
						Username
						<input type="text" name="Username" class="form-control" value="<?= $user->GetAttr("Username") ?>">
					</div>
					<div class="col-6 mb-2">
						Status
						<select class="form-control" name="User_Status">
							<option value=1 <?= $user->GetAttr("User_Status") == 1 ? "selected" : "" ?>>Active</option>
							<option value=0 <?= $user->GetAttr("User_Status") == 0 ? "selected" : "" ?>>Inctive</option>
						</select>
					</div>
					<div class="col-6 mb-2">
						Email
						<input type="text" name="Email" class="form-control" value="<?= $user->GetAttr("Email") ?>">
					</div>
					<div class="col-6 mb-2">
					</div>
					<div class="col-6 mb-2">
						First Name
						<input type="text" name="First_Name" class="form-control" value="<?= $user->GetAttr("First_Name") ?>">
					</div>
					<div class="col-6 mb-2">
						Last Name
						<input type="text" name="Last_Name" class="form-control" value="<?= $user->GetAttr("Last_Name") ?>">
					</div>
					<hr>
					<div class="col-6 mb-2 text-center">
						<span style="font-size: 115%">Groups</span>
						<table id="groups_table" class="table table-striped">
						<thead>
							<tr>
								<th>Group</th>
								<th>Member</th>
							</tr>
						</thead> 
						<tbody>

							<?php foreach($all_groups as $ag){ 
							?>
							<tr>
								<td><?= $ag['Group_Name'] ?></td>
								<td><input type="checkbox" name="group_<?= $ag['Group_ID'] ?>" <?= isset($my_groups_internal[$ag['Group_ID']]) && $my_groups_internal[$ag['Group_ID']] == true ? "Checked" : ""?>></td>

							</tr>
							<?php } ?>
						</tbody>
					</table>
					</div>
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

								<?php foreach(Get_Global_Permissions() as $module=>$permission){ 
								?>
								<tr>
									<td><?= $module ?></td>
									<td><?= key($permission) ?></td>
									<td><input type="checkbox" disabled <?= $user->CheckPermission($module, key($permission)) == true ? "checked" : ""?> ></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<span style="color:red; font-size: 75%">Attention: Permissions can only be inherited at the group level!</span>
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
    $('#groups_table').DataTable();
} );
$(document).ready( function () {
    $('#permissions_table').DataTable();
} );
</script>