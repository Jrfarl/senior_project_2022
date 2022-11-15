<?php
require("../../masterutil.php");
$pagename = "Site Settings";

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
				<button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-selected="false">Profile</button>
			  </li>
			  <li class="nav-item" role="presentation">
				<button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-selected="false">Contact</button>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="core" role="tabpanel">
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
				</div>
			  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
			  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
			</div>
		  </div>
		</div>
	</div>
</div>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>
