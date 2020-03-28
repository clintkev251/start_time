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
    <head>
        <title>Submit History</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
        <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
                <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-cyan.min.css" />
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <style type="text/css">
            .tableContainer{
            display: flex;
            align-items: center;
            justify-content: center;
            }
        </style>
    </head>
    
    <a class="mdc-button mdc-button--raised" href="admin.php">Back</a>
    
    <body>
        <div class="tableContainer">
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
            </div>
    </body>
</html>