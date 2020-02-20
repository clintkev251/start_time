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
        <style>
            table, th, td {
              border: 2px solid black;
              border-collapse: collapse;
              padding: 10px;
            }
            table {
              width: 100%;
            }
            
            tr {
              height: 50px;
              
            }
            thead {
                font-weight: bold;
                color: white;
                background-color: #50A;
            }
            r:not(:first-child):hover {background-color: #f5f5f5;}
        </style>
    </head>
    
    <a class="mdc-button mdc-button--raised" href="admin.php">Back</a>
    
    <body>
        <div class="mdc-card" style="overflow-x:auto;">
        <table>
        <thead>
            <tr>
                <td>Sort</td>
                <td>Date</td>
                <td>Prime</td>
                <td>Unload</td>
                <td>Vanlines</td>
                <td>Start</td>
                <td>Smalls</td>
                <td>Notes</td>
                <td>Updated By</td>
                <td>Updated At</td>
            </tr>
        </thead>
        <tbody>
        <?php
            $results = mysqli_query($link, "SELECT * FROM timesHistory ORDER BY updateID DESC LIMIT 10");
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