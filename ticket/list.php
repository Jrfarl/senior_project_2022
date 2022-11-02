<?php
require("masterutil.php");
$pagename = "View Tickets";
?>
<?php require("templates/base_logged_in_top.php"); ?>


    <!doctype html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>Untitled Document</title>
    </head>

    <body>

        <div class="list-group">

        <?php 
			
           $sql = "
                    SELECT Title, Description, Status_Name, Last_Name, First_Name 
                    FROM Tickets
                    INNER JOIN Status on Tickets.Status_Code = Status.Status_Code
                    INNER JOIN Users on Tickets.Created_By_ID = Users.User_ID";
            $result = $database->query($sql);

            if(isset($result) && !empty($result)) { ?>

                <?php  while($row = mysqli_fetch_assoc($result)) 
                { ?>
                    <!-- row 01 -->

                    <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $row["Title"]; ?></h5>
                        <small><?php echo $row["Status_Name"]; ?></small>
                    </div>
                    <p class="mb-1"><?php echo $row["Description"]; ?></p>
                    <small>
                        Submitted By <?php echo $row["Last_Name"]; 
                        ?>, <?php echo $row["First_Name"]; ?>
                    </small>
                </a>
    
                <? }?>

          <?php
          } else 
            {
              echo "0 results";
          }
          ?>

        </div>


<?php require("templates/base_logged_in_bottom.php"); ?>
