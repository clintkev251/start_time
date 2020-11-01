<?php

if($_COOKIE["isAdmin"] != "y"){
    header("location: not-permitted.php");
    exit;
}

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

// Change user location
if(isset($_POST['Location'])){
    if(!empty($_POST['userChecked'])) {
        $expire = time() + 60 * 60;
        $users[] = "";
        $i = 0;
        foreach($_POST['userChecked'] as $value){
            $users[$i] = $value;
            $i++;
        }
        setcookie("userChange", serialize($users), $expire);
        header("location: user-location.php");
    }
}

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
    <?php include "head.php" ?>
    
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="admin.php">Back</a>
    <a href="register.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Add a user</a>
    
    <body>
        <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
                <thead>
                    <tr>
                        <td></th>
                        <th class="mdl-data-table__cell--non-numeric">User</th>
                        <th>Created At</th>
                        <th>Refered By</th>
                        <th>Location</th>
                        <th>Is Admin</th>
                        <th>Disabled</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $results = mysqli_query($link, "SELECT * FROM users WHERE hidden = '' ORDER BY id");
                    while($row = mysqli_fetch_assoc($results)) {
                    ?>
                        <tr>
                            <td><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo $row['username'] ?>">
                              <input type="checkbox" name="userChecked[]" id="<?php echo $row['username'] ?>" value="<?php echo $row['username'] ?>" class="mdl-checkbox__input">
                              <span class="mdl-checkbox__label"></span>
                            </label></td>
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['created_at']?></td>
                            <td><?php echo $row['referedBy']?></td>
                            <td><?php echo $row['siteAccess']?></td>
                            <td><?php echo $row['isAdmin']?></td>
                            <td><?php echo $row['disabled']?></td>
                        </tr>
        
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </br>
            <div class="mdl-card" style="overflow-x:auto;">
                <button class="mdl-button mdl-js-button mdl-button--accent" style="margin: auto;" type="submit" name="Location" value="Location">Change Location</button>
                <button class="mdl-button mdl-js-button mdl-button--accent" style="margin: auto;" type="submit" name="Disable" value="Disable">Disable</button>
                <button class="mdl-button mdl-js-button mdl-button--accent" style="margin: auto;" type="submit" name="Enable" value="Enable">Enable</button>
                <button class="mdl-button mdl-js-button mdl-button--accent" style="margin: auto;" type="submit" name="Admin" value="Admin">Make admin</button>
                <button class="mdl-button mdl-js-button mdl-button--accent" style="margin: auto;" type="submit" name="Remove" value="Remove">Remove</button>
            </div>
        </form>
    </body>
</html>