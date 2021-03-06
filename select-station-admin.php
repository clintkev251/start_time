<?php
require_once "config.php";
$stationNumber = null;
if (isset($_POST["sel"])) {
    $expire = time() + 60 * 60 * 24 * 360;
    setcookie("stationNumber", $_POST["sel"], $expire);
    header("location: admin.php");
} else if (isset($_COOKIE["stationNumber"])) {
    $stationNumber = $_COOKIE["stationNumber"];
}

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_COOKIE["isAdmin"] != "y"){
    header("location: not-permitted.php");
}
include "head.php";
?>

<html>
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="index.php">Back</a>
    <body>
        <div class="mdc-card">
           <?php $sql = mysqli_query($link, "SELECT * FROM stations"); ?>
           <h5>Select Your Location:</h5>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <select name="sel" size="1" onchange="this.form.submit();">
                        <option></option>
                    <?php while ($stationConfig = mysqli_fetch_assoc($sql)) { ?> 
                        <option value=<?php echo ($stationConfig['stationNumber']); if($stationConfig['stationNumber'] === $stationNumber){?> selected <?php } ?>><?php echo $stationConfig['stationNumber']?>/<?php echo $stationConfig['stationFriendly']?></option> 
                    <?php } ?>
                </select>
            </form>
        </div>
    </body>
</html>