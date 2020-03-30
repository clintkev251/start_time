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

// Get existing data from database - Preload
$sql = mysqli_query($link, "SELECT start,prime,date,unload,smalls,notes FROM times WHERE sort = 'preload'");
$preloadTimes = mysqli_fetch_assoc($sql);
$updatedBy = $_SESSION["username"];
// Outbound
$sql = mysqli_query($link, "SELECT start,prime,date,vanlines,smalls,notes FROM times WHERE sort = 'outbound'");
$outboundTimes = mysqli_fetch_assoc($sql);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
// Set varibles for times
    $updatedBy = $_SESSION["username"];
// Preload
    $preload = "preload";
    $preStart = trim($_POST["start"]);
    $prePrime = trim($_POST["prime"]);
    $preDate = trim($_POST["date"]);
    $preUnload = trim($_POST["unload"]);
    $preSmalls = trim($_POST["smalls"]);
    $preNotes = trim($_POST["notes"]);
// Outbound
    $outbound = "outbound";
    $obStart = trim($_POST["startOB"]);
    $obPrime = trim($_POST["primeOB"]);
    $obDate = trim($_POST["dateOB"]);
    $obVanline = trim($_POST["vanlineOB"]);
    $obSmalls = trim($_POST["smallsOB"]);
    $obNotes = trim($_POST["notesOB"]);
//Create hashes from new data to detect changes
    
// Prepare a sql statement for Preload
    $sql = "UPDATE times SET start = ?, date = ?, prime = ?, unload = ?, smalls = ?, notes = ?, updatedBy = ? WHERE sort = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ssssssss", $preStart, $preDate, $prePrime, $preUnload, $preSmalls, $preNotes, $updatedBy, $preload );
        mysqli_stmt_execute($stmt);
    }
    
// Prepare a sql statement for outbound
    $sql = "UPDATE times SET start = ?, date = ?, prime = ?, vanlines = ?, smalls = ?, notes = ?, updatedBy = ? WHERE sort = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssss", $obStart, $obDate, $obPrime, $obVanline, $obSmalls, $obNotes, $updatedBy, $outbound );
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
<html>

<?php include "head.php" ?>

<a href="logout.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Home</a>
<a href="history.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Submit History</a>
<a href="reset-password.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Change your password</a>
<a href="register.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Add a user</a>
<?php if($isAdmin['isAdmin'] == "y"){ ?> <a href="users.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">User Management</a> <?php } ?>
<body>
    <div class="mdc-card">
        <h4>Edit the following fields below:</h4>
        
        <div id="boxes">
            <div id="leftbox">
                <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off" style="width: 50%; margin: auto; text-align: center;">
                    <h5>Preload:</h5>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" data-language='en' data-date-format='DD MM d' value="<?php echo($preloadTimes["date"]);?>" name="date" id="dateIB"readonly>
                        <label class="mdl-textfield__label mdl-textfield__input" for="dateIB">Date</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="ibUnload" type="text" maxlength="5" style="width: 130px;" value="<?php echo($preloadTimes["unload"]); ?>" name="unload">
                        <label class="mdl-textfield__label mdl-textfield__input" for="ibUnload">Unload (AM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="ibPrime" type="text" maxlength="5" style="width: 130px;" value="<?php echo($preloadTimes["prime"]); ?>" name="prime">
                        <label class="mdl-textfield__label mdl-textfield__input" for="ibPrime">Prime (AM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="ibStart" type="text" maxlength="5" style="width: 130px;" value="<?php echo($preloadTimes["start"]); ?>" name="start">
                        <label class="mdl-textfield__label mdl-textfield__input" for="ibStart">Start (AM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="ibSmalls" type="text" maxlength="5" style="width: 130px;" value="<?php echo($preloadTimes["smalls"]); ?>" name="smalls">
                        <label class="mdl-textfield__label mdl-textfield__input" for="ibSmalls">Smalls (AM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="ibNotes" rows="3" type="text" value="<?php echo($preloadTimes["notes"]); ?>" name="notes"><?php echo($preloadTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="ibNotes">Notes</label>
                    </div>
                </div>
                <div id="rightbox">
                    <h5>Outbound:</h5>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" id="obDate" data-language='en' data-date-format='DD MM d' value="<?php echo($outboundTimes["date"]);?>" name="dateOB"readonly>
                        <label class="mdl-textfield__label mdl-textfield__input" for="obDate">Date</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="obPrime" type="text" maxlength="5" style="width: 130px;" value="<?php echo($outboundTimes["prime"]);?>"name="primeOB">
                        <label class="mdl-textfield__label mdl-textfield__input" for="obPrime">Prime (PM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="obVanlines" type="text" maxlength="5" style="width: 130px;" value="<?php echo($outboundTimes["vanlines"]);?>"name="vanlineOB">
                        <label class="mdl-textfield__label mdl-textfield__input" for="obVanlines">Vanlines (PM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="obSmalls" type="text" maxlength="5" style="width: 130px;" value="<?php echo($outboundTimes["smalls"]);?>"name="smallsOB">
                        <label class="mdl-textfield__label mdl-textfield__input" for="obSmalls">Smalls (PM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="obStart" type="text" maxlength="5" style="width: 130px;" value="<?php echo($outboundTimes["start"]);?>"name="startOB">
                        <label class="mdl-textfield__label mdl-textfield__input" for="obStart">Start (PM)</label>
                    </div>
                    </br>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="ibNotes" rows="3" type="text" value="<?php echo($outboundTimes["notes"]); ?>" name="notes"><?php echo($outboundTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="ibNotes">Notes</label>
                    </div>
                </div>
            </div>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin: auto;" type="submit" name="submit"
                value="Submit">Submit</button>
        </form>
    </div>
</body>

</html>
