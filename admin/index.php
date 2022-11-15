<?php
require("../masterutil.php");
$pagename = "Admin Dashboard";
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
<div class="col-12">
	<div class="col-12">
		<div class="card">
		  <div class="card-body">
			<div class="row mb-2">
				<?php if($me->CheckPermission("admin", "view_user_management")){ ?>
				<a class="btn btn-outline-primary col-12 mb-2" href="usermanagement/">User Management</a>  
				<?php } ?>
				<?php if($me->CheckPermission("admin", "view_group_management")){ ?>
				<a class="btn btn-outline-primary col-12  mb-2" href="groupmanagement/">Group Management</a> 
				<?php } ?>
				<?php if($me->CheckPermission("admin", "view_site_settings")){ ?>
				<a class="btn btn-outline-primary col-12  mb-2" href="settings/">Site Management</a> 
				<?php } ?>
			</div>
		  </div>
		</div>
	</div>
</div>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>