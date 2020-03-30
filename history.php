<?php

// Initialize the session
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php"; 
?>
<html>

<?php include "head.php"; ?>
    
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="admin.php">Back</a>
    
    <body>
        <!--<div class="mdc-card" style="overflow-x:auto">-->
        <table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
            <thead>
                <tr>
                    <th>Sort</td>
                    <th>Date</td>
                    <th>Prime</td>
                    <th>Unload</td>
                    <th>Vanlines</td>
                    <th>Start</td>
                    <th>Smalls</td>
                    <th>Notes</td>
                    <th>Updated By</td>
                    <th>Updated At</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $results = mysqli_query($link, "SELECT * FROM timesHistory ORDER BY updateID DESC LIMIT 100");
                while($row = mysqli_fetch_assoc($results)) {
                ?>
                    <tr>
                        <td><?php echo $row['sort']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['prime']?></td>
                        <td><?php echo $row['unload']?></td>
                        <td><?php echo $row['vanlines']?></td>
                        <td><?php echo $row['start']?></td>
                        <td><?php echo $row['smalls']?></td>
                        <td><?php echo $row['notes']?></td>
                        <td><?php echo $row['updatedBy']?></td>
                        <td><?php echo $row['updatedAt']?></td>
                    </tr>
    
                <?php
                }
                ?>
                </tbody>
            </table>
            <!--</div>-->
    </body>
</html>