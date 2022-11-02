<?php

require("../masterutil.php");

$pagename = "View Tickets";
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>

        <div class="list-group">

        <?php 
			

           $sql = "SELECT Ticket_ID,Title, Description, Status_Name, Last_Name, First_Name 
                   FROM Tickets
                   INNER JOIN Status on Tickets.Status_Code = Status.Status_Code
                   INNER JOIN Users on Tickets.Created_By_ID = Users.User_ID";

            $result = $database->query($sql);

            if(isset($result) && !empty($result)) { ?>


                <?php  foreach($result as $r){ ?>
                    <a href="audit.php?TID=<?=$r['Ticket_ID']?>" class="list-group-item list-group-item-action">
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

