<?php
require("../../masterutil.php");
$pagename = "Site Settings";
$config_controller = new config($database);
$status_controller = new status($database);
$priority_controller = new ticket_priority($database);
if(!empty($_POST)){
	foreach($_POST as $k=>$v){
		switch($k){
			case "config_sitename":
				if($v != $config_controller->GetValue("SITE_NAME")){
					$config_controller->SetKVP("SITE_NAME", $v);
				}
				break;
				
			case "config_debugmode":
				if($v != $config_controller->GetValue("CORE_DEBUG_ACTIVE")){
					$config_controller->SetKVP("CORE_DEBUG_ACTIVE", $v);
				}
				break;
			case "create_status_id":
				if($_POST['create_status_id'] != "" && $_POST['create_status_name'] != "" && is_numeric($_POST['create_status_id'])){
					$status_controller->CreateStatus($_POST['create_status_id'], $_POST['create_status_name']);
				}
				break;
			case "create_priority_id":
				if($_POST['create_priority_id'] != "" && $_POST['create_priority_name'] != "" && is_numeric($_POST['create_priority_id'])){
					$priority_controller->CreatePriority($_POST['create_priority_id'], $_POST['create_priority_name']);
				}
				break;
		}
	}
}
$all_status = $status_controller->GetAll();
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<div class="col-12">
		<div class="card">
		  <div class="card-body">
			<ul class="nav nav-tabs" id="PageTabs" role="tablist">
			  <li class="nav-item" role="presentation">
				<button class="nav-link active"  data-bs-toggle="tab" data-bs-target="#core" type="button" role="tab"  aria-selected="true">Core</button>
			  </li>
			  <li class="nav-item" role="presentation">
				<button class="nav-link" data-bs-toggle="tab" data-bs-target="#ticket_status" type="button" role="tab" aria-selected="false">Ticket Statuses</button>
			  </li>
			  <li class="nav-item" role="presentation">
				<button class="nav-link" data-bs-toggle="tab" data-bs-target="#ticket_priority" type="button" role="tab" aria-selected="false">Ticket Priorities</button>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="core" role="tabpanel">
				  <form action="" method="post">
				  <div class="row mt-2">
				  	<div class="col-6">
						<div class="row  mb-2">
							<span>Site Name:</span>
						</div>
						<div class="row">
							<span>Debug Mode:</span>
						</div>
					</div>
					<div class="col-6">
						<div class="row mb-2">
							<input type="text" name="config_sitename" class="form-control" value="<?= $config->GetValue("SITE_NAME") ?>"></input>
						</div>
					  	<div class="row">
							<select name="config_debugmode" class="form-control">
								<option value="0" <?= $config->GetValue("CORE_DEBUG_ACTIVE") == 0 ? "selected" : "" ?>>Off</option>
								<option value="1" <?= $config->GetValue("CORE_DEBUG_ACTIVE") == 1 ? "selected" : "" ?>>On</option>
							</select>
						</div>
					</div>
				  </div>
				  <div class="row my-2">
				  	<input type="submit" class="btn btn-outline-primary col-12">
				  </div>
				  </form>
				</div>
			  <div class="tab-pane fade" id="ticket_status" role="tabpanel" >
				  <div class="col-12">
					<div class="col-12">
						<div class="card">
						  <div class="card-body">
							<table id="status_table" class="table table-striped">
								<thead>
									<tr>
										<th>Status ID</th>
										<th>Status Name</th>
									</tr>
								</thead> 
								<tbody>

									<?php foreach($all_status as $k=>$v){ ?>
									<tr>
										<td><?= $k ?></td>
										<td><?= $v ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							  <form action="" method="post">
							  <div class="row mt-2">
								  
								  <div class="col-4">
							  		<input type="text" class="form-control" name="create_status_id" id="create_staus_id" placeholder="Status ID">
								  </div>
								  <div class="col-4">
									<input type="text" class="form-control" name="create_status_name" id="create_status_name" placeholder="Status Name">
								  </div>
								  <div class="col-4">
									<input type="submit" class="btn btn-outline-primary col-12" id="create_status" value="Create Status"></a>
								  </div>
								  
							  </div>
							  </form>
						  </div>
						</div>
					</div>
				</div>
			  </div>
			  <div class="tab-pane fade" id="ticket_priority" role="tabpanel">
				 <div class="col-12">
						<div class="col-12">
							<div class="card">
							  <div class="card-body">
								<table id="priority_table" class="table table-striped">
									<thead>
										<tr>
											<th>Priority Level</th>
											<th>Priority Name</th>
										</tr>
									</thead> 
									<tbody>

										<?php foreach($priority_controller->GetAll() as $k=>$v){ ?>
										<tr>
											<td><?= $k ?></td>
											<td><?= $v ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								  <form action="" method="post">
								  <div class="row mt-2">

									  <div class="col-4">
										<input type="text" class="form-control" name="create_priority_id" id="create_priority_id" placeholder="Priority Level">
									  </div>
									  <div class="col-4">
										<input type="text" class="form-control" name="create_priority_name" id="create_priority_name" placeholder="Priority Name">
									  </div>
									  <div class="col-4">
										<input type="submit" class="btn btn-outline-primary col-12" id="create_priority" value="Create Priority"></a>
									  </div>

								  </div>
								  </form>
							  </div>
							</div>
						</div>
					</div>
			</div>
			</div>
		  </div>
		</div>
	</div>
</div>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>

<script>
$(document).ready( function () {
    $('#status_table').DataTable();
} );
$(document).ready( function () {
    $('#priority_table').DataTable();
} );
</script>