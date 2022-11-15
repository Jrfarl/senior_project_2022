<?php
require("../masterutil.php");
$pagename = "Audit Ticket";
if(!isset($_GET['TID'])){
	$error[] = "A Ticket ID was not set in the url or ticket does not exist";
}else{
	
	$ticket = new ticket($database, $_GET['TID']);

	if(isset($_GET['archive']) && $_GET['archive'] == true){
		$ticket->ArchiveTicket($_GET['TID']);
		//header("Location: list.php");
	}

	if($ticket->GetAttr('Created_By_ID') != ''){
		$creation_user = new internal_user($database);
		$creation_user->GetUserFromID($ticket->GetAttr('Created_By_ID'));
	}
	$status = new status($database);
	$all_statuses = $status->GetAll();
	$comment = new comment($database);
	$comments = $comment->SelectAllByTicket($_GET['TID']);
	$priority = new ticket_priority($database);
	$priority_names = $priority->GetAllPriorityNames();
	$group = new user_group($database);
}
$stop = false;
if(!empty($_POST) && isset($_GET['TID'])){
	foreach($_POST as $k=>$v){
		if($k == "new_comment"){
			if($v != ""){
				$comment->InsertComment($_GET['TID'], null, $v, $me->GetAttr("User_ID"));
				header("Location: ".$_SERVER['REQUEST_URI']);
			}else{
				$error[] = "You cannot enter an empty comment!";
			}
			
		}else{
			if(!is_array($v)){
				if($ticket->GetAttr($k) != $v){
					$was_success = $ticket->UpdateTicketAttr($k, $v);
					if($was_success){
						$success[] = "Updated ".$k;
						$ticket->UpdateAuditLog($me);
					}else{
						$error[] = "There was an issue updating ".$k;
					}
				} 
			}else{
				if($ticket->GetAttr($k) != json_encode($v)){
					$was_success = $ticket->UpdateTicketAttr($k, json_encode($v));
					if($was_success){
						$success[] = "Updated ".$k;
						$ticket->UpdateAuditLog($me);
					}else{
						$error[] = "There was an issue updating array ".$k;
					}
				} 
			}
		}
	}
}
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<?php if(is_a($ticket, 'ticket') &&  !$ticket->GetAttr("Ticket_ID") == null){ ?>
	<form action="" method="post">
<div class="col-12">

	<div class="row">
		
		<div class="col-3">
			<div class="card">
			  <div class="card-header">
				Ticket Information
			  </div>
			  <div class="card-body">
					<div class="form">
						<div class="row mb-1">
							<span class="col-12">Status</span>
							<select name="Status_Code" class="form-control bs_selpick">
								<?php foreach($all_statuses as $as){?>
									<option value="<?= $as['Status_Code']?>" <?= $ticket->GetAttr('Status_Code') == $as['Status_Code'] ? "selected" : ""?>><?= $as['Status_Name']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="row mb-1">
							<span class="col-12">Assigned Group:</span>
							<select class="form-control" multiple name="Assigned_To_Group_ID[]">
								<optgroup label="Groups">
									<?php foreach($group->GetAllGroups() as $g){?>
									<option value="<?= $g['Group_ID']?>" <?= in_array($g['Group_ID'], $ticket->GetAttr("Assigned_To_Group_ID")) ? "selected" : ""?>><?= $g['Group_Name']?></option>
									<?php } ?>
								</optgroup>
							</select>
						</div>
						<div class="row mb-1">
							<span class="col-12">Assigned Users:</span>
							<select class="form-control" multiple name="Assigned_To_User_ID[]">
								<optgroup label="Users">
									<?php
									foreach($group->GetUsersInGroups($ticket->GetAttr("Assigned_To_Group_ID")) as $gu){?>
									<option value="<?= $gu['User_ID']?>" <?= in_array($gu['User_ID'], $ticket->GetAttr("Assigned_To_User_ID")) ? "selected" : ""?>><?= $gu['First_Name']." ".$gu['Last_Name']." (".$gu['Username'].")"?></option>
									<?php } ?>
								</optgroup>
							</select>
						</div>
						<div class="row mb-1">
							<span class="col-12">Priority</span>
							<select name="Priority_Level" class="form-control bs_selpick">
								<?php foreach($priority_names as $p){ ?>
									<option <?= $ticket->GetAttr('Priority_Level') == $p['Priority_Level'] ? "selected" : ""?> value="<?=$p['Priority_Level']?>"><?=$p['Priority_Name']?></option>
								<?php } ?>
							</select>
						</div>
				  <hr>
						<div class="row mb-1">
							<div class="col-12 mb-2">
								<div class="row">
									<span class="col-12">Created By:</span>
									<input type="text" class="form-control" value="<?= (isset($creation_user) && $creation_user->GetAttr("Last_Name") != "") ? $creation_user->GetAttr("Last_Name").", ".$creation_user->GetAttr("First_Name") : 'There was an issue retrieving the creation user' ?>" readonly>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<span class="col-12">Created On:</span>
									<input type="text" class="form-control" value="<?= $ticket->GetAttr('Date_Created') ?>" readonly>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<span class="col-12">Last Audit Made By:</span>
									<input type="text" class="form-control" value="<?= isset($ticket->GetAttr('Metadata')['Last_Audit_User']) ? $ticket->GetAttr('Metadata')['Last_Audit_User'] : "No Audits Have Been Made" ?>" readonly>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<span class="col-12">Last Audit On:</span>
									<input type="text" class="form-control" value="<?= isset($ticket->GetAttr('Metadata')['Last_Audit_Date']) ? $ticket->GetAttr('Metadata')['Last_Audit_Date'] : "No Audits Have Been Made" ?>" readonly>
								</div>
							</div>
						</div>

						<hr>
						<div class="row mb-1">
							<span class="text-center mb-1">Actions</span>
								<input type="submit" value="Update Ticket" class="btn btn-outline-primary col-12 mb-2">
								<a id="Archive Button" class="btn btn-outline-danger col-12" href="<?php echo 'audit.php?TID=' . $_GET['TID'] . '&archive=true'?>">Archive Ticket</a>
								<!--<input type="button" class="btn btn-outline-danger col-12" value="Archive Ticket"></input>-->
							</div>
					</div>  
			  </div>
			</div>
		</div>
		<div class="col-9">
			<div class="card mb-1">
			  <div class="card-header">
				Audit Ticket
			  </div>
			  <div class="card-body">
					<div class="form">
						<div class="row mb-1">
							<div class="col-6">
								<input class="form-control" placeholder="Title" name="Title" value="<?= $ticket->GetAttr("Title")?>">
							</div>
							<div class="col-12 mt-2">
								<textarea class="form-control" rows="12" readonly placeholder="Explain in as much detail as possible the reason for the ticket"><?= $ticket->GetAttr("Description")?></textarea>
							</div>
						</div>
					</div>  
			  </div>
			</div>
			</form>
			<div class="card">
			  <div class="card-header">
				Comments
			  </div>
			  <div class="card-body">
					<div class="form">
						<div class="row mb-1">
							<?php if(count($comments) == 0 ){?>
							<div class="row mb-2">
								<div class="col-12 text-center">There are no active comments</div>
							</div>
							<hr>
							<?php }else{ ?>
							<?php foreach($comments as $c){ ?>
							<div class="row mb-2">
								<div class="col-12"><span><?= $c['Comment_Text'] ?></span></div>
							</div>
							<hr>
							<?php } ?>
							<?php } ?>
							<form name="ins_comment" method="post" action="">
							<div class="col-12 mt-2">
								<textarea class="form-control" rows="2" name="new_comment"  placeholder="Comment"></textarea>
							</div>
							<div class="col-12 mt-2">
								<input type="submit" class="btn btn-outline-primary float-end" value="Create Comment">
							</div>
							</form>
						</div>
					</div>  
			  </div>
			</div>
		</div>
	</div>

</div>

<?php } ?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>

<script>
$('.bs_selpick').selectpicker();
</script>
