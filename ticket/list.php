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
=======

$pagename = "View Tickets";
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>

        <div class="list-group">

        <?php 
			
           $sql = "SELECT Title, Description, Status_Name, Last_Name, First_Name 
                   FROM Tickets
                   INNER JOIN Status on Tickets.Status_Code = Status.Status_Code
                   INNER JOIN Users on Tickets.Created_By_ID = Users.User_ID";
            $result = $database->query($sql);

            if(isset($result) && !empty($result)) { ?>

                <?php  foreach($result as $r){ ?>
                    <!-- row 01 -->

                    <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $r["Title"]; ?></h5>
                        <small><?= $r["Status_Name"]; ?></small>
                    </div>
                    <p class="mb-1"><?= $r["Description"]; ?></p>
                    <small>
                        Submitted By <?= $r["Last_Name"].", ".$r["First_Name"] ?>
                    </small>
                </a>
    
                <?php }?>

          <?php
          } else {
              echo "0 results";
          }
          ?>

        </div>


<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>
>>>>>>> Stashed changes
