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

$users[] = unserialize($_COOKIE["userChange"]);


require_once "config.php";
$stationNumber = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "UPDATE users SET siteAccess = ? WHERE username = ?";
    $station = intval(trim($_POST["sel"]));
    $i = 0; 
    while($i<count($users[0])){
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "is", $station, $users[0][$i]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        $i++;
    }
    header("location: users.php");
}

include "head.php"
?>

<html>
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="users.php">Back</a>
    <body>
        <div class="mdl-card">
           <?php $sql = mysqli_query($link, "SELECT * FROM stations"); ?>
           <h5>The following users locations will be changed on submit:</h5>
           <h6><?php $i = 0; while($i<count($users[0])){echo $users[0][$i], ", "; $i++;} ?></h6>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <select name="sel" size="1">
                        <option></option>
                    <?php while ($stationConfig = mysqli_fetch_assoc($sql)) { ?> 
                        <option value=<?php echo ($stationConfig['stationNumber']); if($stationConfig['stationNumber'] === $stationNumber){?> selected <?php } ?>><?php echo $stationConfig['stationNumber']?>/<?php echo $stationConfig['stationFriendly']?></option> 
                    <?php } ?>
                </select>
                </br></br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin: auto;" type="submit" name="submit" value="Submit">Submit</button>
            </form>
        </div>
    </body>
</html>