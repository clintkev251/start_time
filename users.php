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

// Disable
if(isset($_POST['Disable'])){
    if(!empty($_POST['userChecked'])) {    
        foreach($_POST['userChecked'] as $value){
            $sql = "UPDATE users SET disabled = 'y' WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $value);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}

// Enable
if(isset($_POST['Enable'])){
    if(!empty($_POST['userChecked'])) {    
        foreach($_POST['userChecked'] as $value){
            $sql = "UPDATE users SET disabled = '' WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $value);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}

// Remove
if(isset($_POST['Remove'])){
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-cyan.min.css" />
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    </head>
    
    <a class="mdc-button mdc-button--raised" href="admin.php">Back</a>
    <a href="register.php" class="mdc-button mdc-button--raised">Add a user</a>
    
    <body>
        <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mdc-card" style="overflow-x:auto;">
                <table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
                    <thead>
                        <tr>
                            <td></th>
                            <th class="mdl-data-table__cell--non-numeric">User</th>
                            <th>Created At</th>
                            <th>Is Admin</th>
                            <th>Disabled</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $results = mysqli_query($link, "SELECT * FROM users ORDER BY id");
                        while($row = mysqli_fetch_assoc($results)) {
                        ?>
                            <tr>
                                <td><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo $row['username'] ?>">
                                  <input type="checkbox" name="userChecked[]" id="<?php echo $row['username'] ?>" value="<?php echo $row['username'] ?>" class="mdl-checkbox__input">
                                  <span class="mdl-checkbox__label"></span>
                                </label></td>
                                <td><?php echo $row['username']?></td>
                                <td><?php echo $row['created_at']?></td>
                                <td><?php echo $row['isAdmin']?></td>
                                <td><?php echo $row['disabled']?></td>
                            </tr>
            
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </br>
                <div>
                    <button class="mdc-button mdc-button" style="margin: auto;" type="submit" name="Disable" value="Disable">Disable</button>
                    <button class="mdc-button mdc-button" style="margin: auto;" type="submit" name="Enable" value="Enable">Enable</button>
                    <button class="mdc-button mdc-button" style="margin: auto;" type="submit" name="Admin" value="Admin">Make admin</button>
                    <button class="mdc-button mdc-button" style="margin: auto;" type="submit" name="Remove" value="Remove">Remove</button>
                </div>
           </div>
        </form>
    </body>
</html>