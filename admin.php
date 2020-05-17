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
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'preload'");
$preloadTimes = mysqli_fetch_assoc($sql);
$updatedBy = $_SESSION["username"];
// Outbound
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'outbound'");
$outboundTimes = mysqli_fetch_assoc($sql);
// OTP
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'otp'");
$otpTimes = mysqli_fetch_assoc($sql);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
// Set varibles for times
    $updatedBy = $_SESSION["username"];
// Preload
    $preload = "preload";
    $preStart = trim($_POST["start"]);
    $prePrime = trim($_POST["prime"]);
    $preDate = trim($_POST["date"]);
    $preUnload = trim($_POST["unload"]);
    $preVanlines = trim($_POST["vanlines"]);
    $preSmalls = trim($_POST["smalls"]);
    $preNotes = trim($_POST["notes"]);
// Outbound
    $outbound = "outbound";
    $obStart = trim($_POST["startOB"]);
    $obPrime = trim($_POST["primeOB"]);
    $obDate = trim($_POST["dateOB"]);
    $obUnload = trim($_POST["unloadOB"]);
    $obVanlines = trim($_POST["vanlinesOB"]);
    $obSmalls = trim($_POST["smallsOB"]);
    $obNotes = trim($_POST["notesOB"]);
    
// OTP
    $otp = "otp";
    $otpStart = trim($_POST["startOTP"]);
    $otpPrime = trim($_POST["primeOTP"]);
    $otpDate = trim($_POST["dateOTP"]);
    $otpUnload = trim($_POST["unloadOTP"]);
    $otpVanlines = trim($_POST["vanlinesOTP"]);
    $otpSmalls = trim($_POST["smallsOTP"]);
    $otpNotes = trim($_POST["notesOTP"]);
    
// Prepare a sql statement for Preload
    $sql = "UPDATE times SET start = ?, date = ?, prime = ?, unload = ?, vanlines = ?, smalls = ?, notes = ?, updatedBy = ? WHERE sort = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sssssssss", $preStart, $preDate, $prePrime, $preUnload, $preVanlines, $preSmalls, $preNotes, $updatedBy, $preload );
        mysqli_stmt_execute($stmt);
    }
    
// Prepare a sql statement for outbound
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssss", $obStart, $obDate, $obPrime, $obUnload, $obVanlines, $obSmalls, $obNotes, $updatedBy, $outbound );
            mysqli_stmt_execute($stmt);
        }

// Prepare a sql statement for otp
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssss", $otpStart, $otpDate, $otpPrime, $otpUnload, $otpVanlines, $otpSmalls, $otpNotes, $updatedBy, $otp );
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
<html>

<?php include "head.php" ?>
<style type="text/css">
    .mdl-textfield{padding-bottom: 24px;}
</style>
<a href="logout.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Home</a>
<a href="history.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Submit History</a>
<a href="reset-password.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Change your password</a>
<a href="register.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Add a user</a>
<?php if($isAdmin['isAdmin'] == "y"){ ?> <a href="users.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">User Management</a> <?php } ?>
<body>
    <div class="mdc-card">
        <h4>Edit the following fields below:</h4>
            <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off" style="width: 50%; margin: auto; text-align: center;">
                <div <?php if(!$preloadFlag){ ?> style=display:none <?php } ?>>
                    <h5>Preload:</h5>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" data-language='en' data-date-format='DD MM d' value="<?php echo($preloadTimes["date"]);?>" name="date" id="dateIB"readonly>
                        <label class="mdl-textfield__label" for="dateIB">Date</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadUnloadFlag){ ?> style=display:none <?php } ?> >
                        <input class="mdl-textfield__input" id="ibUnload" type="text" maxlength="5"  value="<?php echo($preloadTimes["unload"]); ?>" name="unload">
                        <label class="mdl-textfield__label" for="ibUnload">Unload (AM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadVanlinesFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ibVanlines" type="text" maxlength="5"  value="<?php echo($preloadTimes["vanlines"]); ?>" name="vanlines">
                        <label class="mdl-textfield__label" for="ibVanlines">Vanlines (AM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadPrimeFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ibPrime" type="text" maxlength="5"  value="<?php echo($preloadTimes["prime"]); ?>" name="prime">
                        <label class="mdl-textfield__label" for="ibPrime">Prime (AM)</label>
                        <!--</br>-->                    
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadStartFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ibStart" type="text" maxlength="5"  value="<?php echo($preloadTimes["start"]); ?>" name="start">
                        <label class="mdl-textfield__label" for="ibStart">Start (AM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadSmallsFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ibSmalls" type="text" maxlength="5" value="<?php echo($preloadTimes["smalls"]); ?>" name="smalls">
                        <label class="mdl-textfield__label" for="ibSmalls">Smalls (AM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="ibNotes" rows="3" type="text" value="<?php echo($preloadTimes["notes"]); ?>" name="notes"><?php echo($preloadTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="ibNotes">Notes</label>
                    </div>
                </div>
                <div <?php if(!$outboundFlag){ ?> style=display:none <?php } ?>>
                    <h5>Outbound:</h5>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" id="obDate" data-language='en' data-date-format='DD MM d' value="<?php echo($outboundTimes["date"]);?>" name="dateOB"readonly>
                        <label class="mdl-textfield__label" for="obDate">Date</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundPrimeFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="obPrime" type="text" maxlength="5"  value="<?php echo($outboundTimes["prime"]);?>"name="primeOB">
                        <label class="mdl-textfield__label" for="obPrime">Prime (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundUnloadFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="obUnload" type="text" maxlength="5"  value="<?php echo($outboundTimes["unload"]);?>"name="unloadOB">
                        <label class="mdl-textfield__label" for="obUnload">Unload (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundVanlinesFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="obVanlines" type="text" maxlength="5"  value="<?php echo($outboundTimes["vanlines"]);?>"name="vanlinesOB">
                        <label class="mdl-textfield__label" for="obVanlines">Vanlines (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundSmallsFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="obSmalls" type="text" maxlength="5"  value="<?php echo($outboundTimes["smalls"]);?>"name="smallsOB">
                        <label class="mdl-textfield__label" for="obSmalls">Smalls (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundStartFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="obStart" type="text" maxlength="5"  value="<?php echo($outboundTimes["start"]);?>"name="startOB">
                        <label class="mdl-textfield__label" for="obStart">Start (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="obNotes" rows="3" type="text" value="<?php echo($outboundTimes["notes"]); ?>" name="notesOB"><?php echo($outboundTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="obNotes">Notes</label>
                    </div>
                </div>
                <div<?php if(!$otpFlag){ ?> style=display:none <?php } ?>>
                    <h5>OTP:</h5>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" id="otpDate" data-language='en' data-date-format='DD MM d' value="<?php echo($otpTimes["date"]);?>" name="dateOTP"readonly>
                        <label class="mdl-textfield__label" for="otpDate">Date</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpPrimeFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otpPrime" type="text" maxlength="5"  value="<?php echo($otpTimes["prime"]);?>"name="primeOTP">
                        <label class="mdl-textfield__label" for="otpPrime">Prime (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpUnloadFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otpUnload" type="text" maxlength="5"  value="<?php echo($otpTimes["unload"]);?>"name="unloadOTP">
                        <label class="mdl-textfield__label" for="otpUnload">Unload (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpVanlinesFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otpVanlines" type="text" maxlength="5"  value="<?php echo($otpTimes["vanlines"]);?>"name="vanlinesOTP">
                        <label class="mdl-textfield__label" for="otpVanlines">Vanlines (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpSmallsFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" type="text" id="otpSmalls" maxlength="5"  value="<?php echo($otpTimes["smalls"]);?>"name="smallsOTP">
                        <label class="mdl-textfield__label" for="otpSmalls">Smalls (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpStartFlag){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otpStart" type="text" maxlength="5"  value="<?php echo($otpTimes["start"]);?>"name="startOTP">
                        <label class="mdl-textfield__label" for="otpStart">Start (PM)</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="obNotes" rows="3" type="text" value="<?php echo($otpTimes["notes"]); ?>" name="notesOTP"><?php echo($otpTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="otpNotes">Notes</label>
                    </div>
                </div>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin: auto;" type="submit" name="submit"
                value="Submit">Submit</button>
            </form>
    </div>
</body>


</html>
