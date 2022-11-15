<?php
require("../../masterutil.php");
$pagename = "Group Management";

if(!$me->CheckPermission("admin", "create_new_group")){
	header("Location: /dashboard.php");
}

$group_controller = new user_group($database);
$permissions = Get_Global_Permissions();

if(!empty($_POST)){
	if(isset($_POST['Group_Name']) && $_POST['Group_Name'] != ""){
		$group_id = $group_controller->CreateGroup($_POST['Group_Name']);
	}
	foreach($permissions as $k=>$p){
		if(isset($_POST['permission_'.key($p)])){
			$group_controller->AddGroupPermission($group_id,$permissions[$k][key($p)]);
		}
	}
	header("Location: index.php");
}
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<a href="index.php" class="btn btn-outline-danger">Go Back</a>
	<div class="col-12 mt-1">
		<div class="card">
		  <div class="card-body">
			<form action="" method="post">
				<div class="row">
					<div class="col-12 mb-2">
						Group Name
						<input type="text" name="Group_Name" class="form-control">
					</div>
					<div class="col-12 mb-2">
					</div>
					<hr>
					<div class="col-12 mb-2 text-center">
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
									foreach($permission as $k=>$p){
//										print_r($p)
								?>
								<tr>
									<td><?= $module ?></td>
									<td><?= $k ?></td>
									<td><input name="permission_<?= $k ?>" type="checkbox" <?= $me->CheckPermission($module, $k) == true ? "" : "disabled"?>
									<?= ($me->CheckPermission("admin", "edit_group_permissions")) == true ? "" : "disabled" ?>></td>
								</tr>
								<?php }}?>
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