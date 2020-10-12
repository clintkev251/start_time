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
if (isset($_COOKIE["stationNumber"])) {
    $stationNumber = $_COOKIE["stationNumber"];
}
else{
    header('Location: select-station-admin.php');
    exit;
}
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
                    <th>Field 1</td>
                    <th>Field 2</td>
                    <th>Field 3</td>
                    <th>Field 4</td>
                    <th>Field 5</td>
                    <th>Field 6</td>
                    <th>Field 7</td>
                    <th>Field 8</td>
                    <th>Field 9</td>
                    <th>Updated By</td>
                    <th>Updated At</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $results = mysqli_query($link, "SELECT * FROM timesHistory WHERE stationNumber = $stationNumber ORDER BY updateID DESC LIMIT 100");
                while($row = mysqli_fetch_assoc($results)) {
                ?>
                    <tr>
                        <td><?php echo $row['sort']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['field1']?></td>
                        <td><?php echo $row['field2']?></td>
                        <td><?php echo $row['field3']?></td>
                        <td><?php echo $row['field4']?></td>
                        <td><?php echo $row['field5']?></td>
                        <td><?php echo $row['field6']?></td>
                        <td><?php echo $row['field7']?></td>
                        <td><?php echo $row['field8']?></td>
                        <td><?php echo $row['field9']?></td>
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