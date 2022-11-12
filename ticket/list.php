<?php

require("../masterutil.php");

$pagename = "View Tickets";
?>
<?php require($CONST_TEMPLATEDIR."/base_logged_in_top.php"); ?>

        <<div class="list-group">

            <?php 
                $Ticket = new ticket($database);
                
                $entries_per_page = 10;  

                $totalEntries = $Ticket -> GetPaginationNums();

                $num_pages = ceil($totalEntries[0]['count']/ $entries_per_page);

                if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                } else {  
                    $page = $_GET['page'];  
                } 

                $page_offset = ($page - 1) * $entries_per_page;

            $sql = "SELECT Ticket_ID,Title, Status_Name, Last_Name, First_Name 
                    FROM Tickets
                    INNER JOIN Status on Tickets.Status_Code = Status.Status_Code
                    INNER JOIN Users on Tickets.Created_By_ID = Users.User_ID
                    LIMIT ?, ?";

                $result = $database->query($sql, [$page_offset, $entries_per_page]);

                if(isset($result) && !empty($result)) { ?>


                    <?php  foreach($result as $r){ ?>
                        <a href="audit.php?TID=<?=$r['Ticket_ID']?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= $r["Title"]; ?></h5>
                            <small><?= $r["Status_Name"]; ?></small>
                        </div>
                        <!--<p class="mb-1"><?= $r["Description"]; ?></p> -->
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

        <nav aria-label="Change Page">
            <ul class="pagination">
                
                <?php
                    if($page != 1){
                        echo '
                        <li class="page-item">
                            <a class="page-link" href="list.php?page=' . $page - 1  .'"> '. "Prev" .' </a>
                        </li> 
                        ';
                    } else {
                        echo '
                        <li class="page-item disabled">
                            <a class="page-link" href="list.php?page=' . $page - 1  .'"> '. "Prev" .' </a>
                        </li> 
                        ';

                    }
                ?>                  
                
                <?php
                    for($pageLoop = 1; $pageLoop<= $num_pages; $pageLoop++) {  
                        if($pageLoop != $page){
                            echo '
                                <li class="page-item">
                                <a class="page-link" href = "list.php?page=' . $pageLoop . '">' . $pageLoop . ' </a>
                                </li>';  
                        } else {
                            echo '
                                <li class="page-item active">
                                <a class="page-link" href = "list.php?page=' . $pageLoop . '">' . $pageLoop . ' </a>
                                </li>';  
                        }
                    } 
                ?>

                <?php
                    if($page != $num_pages){
                        echo '
                        <li class="page-item">
                            <a class="page-link" href="list.php?page=' . $page + 1  .'"> '. "Next" . ' </a>
                        </li> 
                        ';
                    } else {
                        echo '
                        <li class="page-item disabled">
                            <a class="page-link" href="list.php?page=' . $page + 1  .'"> '. "Next" . ' </a>
                        </li> 
                        ';
                    }
                ?>
            </ul>
        </nav>

<?php require($CONST_TEMPLATEDIR."/base_logged_in_bottom.php"); ?>
