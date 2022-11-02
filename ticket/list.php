<?php
require("../masterutil.php");
<<<<<<< Updated upstream
$pagename = "Dashboard";
$tickets = new ticket();
$unassigned = $tickets->GetUnassignedTickets();
$unassigned_count = count($unassigned);
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>
	
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#my_tickets" type="button" role="tab" aria-selected="true">My Tickets</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#all_tickets" type="button" role="tab">All Tickets</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="my_tickets" role="tabpanel">abc</div>
  <div class="tab-pane fade" id="all_tickets" role="tabpanel">123</div>
</div>

<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>