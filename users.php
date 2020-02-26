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

$currentUser = $_SESSION["username"];
$sql = "SELECT * FROM users WHERE username = ?";
if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $currentUser);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            $isAdmin = mysqli_fetch_assoc($result);
        }
//$isAdmin  = mysqli_fetch_assoc($stmt);
if($isAdmin['isAdmin'] != "y"){
    header("location: login.php");
    exit;
}        

// Process form imput

// User Reset
if(isset($_POST['Reset'])){
    if(!empty($_POST['userChecked'])) {    
        foreach($_POST['userChecked'] as $value){
            $sql = "UPDATE users SET isAdmin = '' WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $value);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}

// Make Admin
if(isset($_POST['Admin'])){
    if(!empty($_POST['userChecked'])) {    
        foreach($_POST['userChecked'] as $value){
            $sql = "UPDATE users SET isAdmin = 'y' WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $value);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}

// Delete
if(isset($_POST['Delete'])){
    if(!empty($_POST['userChecked'])) {    
        foreach($_POST['userChecked'] as $value){
            $sql = "DELETE FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $value);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}
?>

<html>
    <head>
        <title>User Management</title>
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
              padding: 5px;
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
        </style>
    </head>
    
    <a class="mdc-button mdc-button--raised" href="admin.php">Back</a>
    <a href="register.php" class="mdc-button mdc-button--raised">Add a user</a>
    
    <body>
        <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mdc-card" style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <td></td>
                            <td>User</td>
                            <td>Created At</td>
                            <td>Is Admin</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $results = mysqli_query($link, "SELECT * FROM users ORDER BY id");
                        while($row = mysqli_fetch_assoc($results)) {
                        ?>
                            <tr>
                                <td><input type="checkbox" name="userChecked[]" value="<?php echo $row['username'] ?>"/></td>
                                <td><?php echo $row['username']?></td>
                                <td><?php echo $row['created_at']?></td>
                                <td><?php echo $row['isAdmin']?></td>
                            </tr>
            
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </br>
                <div>
                    <button class="mdc-button mdc-button" style="margin: auto;" type="submit" name="Delete" value="Delete">Delete</button>
                    <!--<button class="mdc-button mdc-button" style="margin: auto;" type="submit" name="Reset" value="Reset">Remove admin</button>-->
                    <button class="mdc-button mdc-button" style="margin: auto;" type="submit" name="Admin" value="Admin">Make admin</button>
                </div>
           </div>
        </form>
    </body>
</html>