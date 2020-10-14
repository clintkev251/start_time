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

$currentUser = $_SESSION["username"];
$sql = "SELECT * FROM users WHERE username = ?";
if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $currentUser);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            $isAdmin = mysqli_fetch_assoc($result);
        }
if (isset($_POST["sel"])) {
    $expire = time() + 60 * 60 * 24 * 360;
    setcookie("stationNumber", $_POST["sel"], $expire);
    header("location: " . $_SERVER["PHP_SELF"]);
} else if (isset($_COOKIE["stationNumber"])) {
    $stationNumber = $_COOKIE["stationNumber"];
}



// Get existing data from database - Preload
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'Preload' AND stationNumber = $stationNumber");
$preloadTimes = mysqli_fetch_assoc($sql);
$updatedBy = $_SESSION["username"];
// Outbound
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'Outbound' AND stationNumber = $stationNumber");
$outboundTimes = mysqli_fetch_assoc($sql);
// OTP
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'OTP' AND stationNumber = $stationNumber");
$otpTimes = mysqli_fetch_assoc($sql);




if($_SERVER["REQUEST_METHOD"] == "POST"){
    
// Set varibles for times
    $updatedBy = $_SESSION["username"];
// Preload
    $preload = "Preload";
    $ibDate = trim($_POST["dateIB"]);
    $ib1 = trim($_POST["ib1"]);
    $ib2 = trim($_POST["ib2"]);
    $ib3 = trim($_POST["ib3"]);
    $ib4 = trim($_POST["ib4"]);
    $ib5 = trim($_POST["ib5"]);
    $ib6 = trim($_POST["ib6"]);
    $ib7 = trim($_POST["ib7"]);
    $ib8 = trim($_POST["ib8"]);
    $ib9 = trim($_POST["ib9"]);
    $ibNotes = trim($_POST["ibnotes"]);
// Outbound
    $outbound = "Outbound";
    $obDate = trim($_POST["dateOB"]);
    $ob1 = trim($_POST["ob1"]);
    $ob2 = trim($_POST["ob2"]);
    $ob3 = trim($_POST["ob3"]);
    $ob4 = trim($_POST["ob4"]);
    $ob5 = trim($_POST["ob5"]);
    $ob6 = trim($_POST["ob6"]);
    $ob7 = trim($_POST["ob7"]);
    $ob8 = trim($_POST["ob8"]);
    $ob9 = trim($_POST["ob9"]);
    $obNotes = trim($_POST["obnotes"]);
    
// OTP
    $otp = "OTP";
    $otpDate = trim($_POST["dateOTP"]);
    $otp1 = trim($_POST["otp1"]);
    $otp2 = trim($_POST["otp2"]);
    $otp3 = trim($_POST["otp3"]);
    $otp4 = trim($_POST["otp4"]);
    $otp5 = trim($_POST["otp5"]);
    $otp6 = trim($_POST["otp6"]);
    $otp7 = trim($_POST["otp7"]);
    $otp8 = trim($_POST["otp8"]);
    $otp9 = trim($_POST["otp9"]);
    $otpNotes = trim($_POST["otpnotes"]);
    
// Prepare a sql statement for Preload
    $sql = "UPDATE times SET date = ?, notes = ?, field1 = ?, field2 = ?, field3 = ?, field4 = ?, field5 = ?, field6 = ?, field7 = ?, field8 = ?, field9 = ?, updatedBy = ? WHERE stationNumber = ? AND sort = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ssssssssssssis", $ibDate, $ibNotes, $ib1, $ib2, $ib3, $ib4, $ib5, $ib6, $ib7, $ib8, $ib9, $updatedBy, $stationNumber, $preload);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else{echo('update fail');}
    
    
// Prepare a sql statement for outbound
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssssssssis", $obDate, $obNotes, $ob1, $ob2, $ob3, $ob4, $ob5, $ob6, $ob7, $ob8, $ob9, $updatedBy, $stationNumber, $outbound);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

// Prepare a sql statement for otp
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssssssssis", $otpDate, $otpNotes, $otp1, $otp2, $otp3, $otp4, $otp5, $otp6, $otp7, $otp8, $otp9, $updatedBy, $stationNumber, $otp);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
<html>

<?php include "head.php" ?>
<style type="text/css">
    .mdl-textfield{padding-bottom: 24px;}
    .alert {
      padding: 20px;
      background-color: #f44336; /* Red */
      color: white;
      margin-bottom: 15px;
    }
</style>
<?php
$sql = mysqli_query($link, "SELECT * FROM stations");
?>

<a href="logout.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Home</a>
<a href="history.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Submit History</a>
<a href="reset-password.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Change your password</a>
<a href="register.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Add a user</a>
<?php if($isAdmin['isAdmin'] == "y"){ ?><a href="station-editor.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Station Editor</a> <?php } ?>
<?php if($isAdmin['isAdmin'] == "y"){ ?><a href="select-station-admin.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Change Station</a> <?php } ?>
<?php if($isAdmin['isAdmin'] == "y"){ ?><a href="users.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">User Management</a> <?php } ?>

<body>
    <?php 
    $sql = mysqli_query($link, "SELECT * FROM stations WHERE stationNumber = $stationNumber");
    $sortData = mysqli_fetch_assoc($sql);
    $sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE stationNumber = $stationNumber AND sort = 'Preload'");
    $preloadFields = mysqli_fetch_assoc($sql);
    $sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE stationNumber = $stationNumber AND sort = 'Outbound'");
    $outboundFields = mysqli_fetch_assoc($sql);
    $sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE stationNumber = $stationNumber AND sort = 'OTP'");
    $otpFields = mysqli_fetch_assoc($sql);
    ?>
    <div class="mdc-card">
        <h4>Edit the following fields below:</h4>
            <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off" style="width: 50%; margin: auto; text-align: center;">
                <div <?php if($sortData['preloadFlag'] == 'n'){ ?> style=display:none <?php } ?>>
                    <h5>Preload:</h5>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" data-language='en' data-date-format='DD MM d' value="<?php echo($preloadTimes["date"]);?>" name="dateIB" id="dateIB"readonly>
                        <label class="mdl-textfield__label" for="dateIB">Date</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="ib1" type="text" maxlength="8"  value="<?php echo($preloadTimes["field1"]); ?>" name="ib1">
                        <label class="mdl-textfield__label" for="ib1"><?php echo($preloadFields['field1']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field2']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib2" type="text" maxlength="8"  value="<?php echo($preloadTimes["field2"]); ?>" name="ib2">
                        <label class="mdl-textfield__label" for="ib2"><?php echo($preloadFields['field2']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field3']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib3" type="text" maxlength="8"  value="<?php echo($preloadTimes["field3"]); ?>" name="ib3">
                        <label class="mdl-textfield__label" for="ib3"><?php echo($preloadFields['field3']) ?></label>
                        <!--</br>-->                    
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field4']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib4" type="text" maxlength="8"  value="<?php echo($preloadTimes["field4"]); ?>" name="ib4">
                        <label class="mdl-textfield__label" for="ib4"><?php echo($preloadFields['field4']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field5']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib5" type="text" maxlength="8" value="<?php echo($preloadTimes["field5"]); ?>" name="ib5">
                        <label class="mdl-textfield__label" for="ib5"><?php echo($preloadFields['field5']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field6']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib6" type="text" maxlength="8" value="<?php echo($preloadTimes["field6"]); ?>" name="ib6">
                        <label class="mdl-textfield__label" for="ib6"><?php echo($preloadFields['field6']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field7']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib7" type="text" maxlength="8" value="<?php echo($preloadTimes["field7"]); ?>" name="ib7">
                        <label class="mdl-textfield__label" for="ib7"><?php echo($preloadFields['field7']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field8']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib8" type="text" maxlength="8" value="<?php echo($preloadTimes["field8"]); ?>" name="ib8">
                        <label class="mdl-textfield__label" for="ib8"><?php echo($preloadFields['field8']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$preloadFields['field9']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ib9" type="text" maxlength="8" value="<?php echo($preloadTimes["field9"]); ?>" name="ib9">
                        <label class="mdl-textfield__label" for="ib9"><?php echo($preloadFields['field9']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="ibNotes" rows="3" type="text" value="<?php echo($preloadTimes["notes"]); ?>" name="ibnotes"><?php echo($preloadTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="ibNotes">Notes</label>
                    </div>
                </div>
                <div <?php if(!$sortData['outboundFlag'] == 'n'){ ?> style=display:none <?php } ?>>
                    <h5>Outbound:</h5>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" data-language='en' data-date-format='DD MM d' value="<?php echo($outboundTimes["date"]);?>" name="dateOB" id="dateOB"readonly>
                        <label class="mdl-textfield__label" for="dateOB">Date</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="ob1" type="text" maxlength="8"  value="<?php echo($outboundTimes["field1"]); ?>" name="ob1">
                        <label class="mdl-textfield__label" for="ob1"><?php echo($outboundFields['field1']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field2']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob2" type="text" maxlength="8"  value="<?php echo($outboundTimes["field2"]); ?>" name="ob2">
                        <label class="mdl-textfield__label" for="ob2"><?php echo($outboundFields['field2']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field3']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob3" type="text" maxlength="8"  value="<?php echo($outboundTimes["field3"]); ?>" name="ob3">
                        <label class="mdl-textfield__label" for="ob3"><?php echo($outboundFields['field3']) ?></label>
                        <!--</br>-->                    
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field4']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob4" type="text" maxlength="8"  value="<?php echo($outboundTimes["field4"]); ?>" name="ob4">
                        <label class="mdl-textfield__label" for="ob4"><?php echo($outboundFields['field4']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field5']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob5" type="text" maxlength="8" value="<?php echo($outboundTimes["field5"]); ?>" name="ob5">
                        <label class="mdl-textfield__label" for="ob5"><?php echo($outboundFields['field5']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field6']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob6" type="text" maxlength="8" value="<?php echo($outboundTimes["field6"]); ?>" name="ob6">
                        <label class="mdl-textfield__label" for="ob6"><?php echo($outboundFields['field6']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field7']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob7" type="text" maxlength="8" value="<?php echo($outboundTimes["field7"]); ?>" name="ob7">
                        <label class="mdl-textfield__label" for="ob7"><?php echo($outboundFields['field7']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field8']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob8" type="text" maxlength="8" value="<?php echo($outboundTimes["field8"]); ?>" name="ob8">
                        <label class="mdl-textfield__label" for="ob8"><?php echo($outboundFields['field8']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$outboundFields['field9']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="ob9" type="text" maxlength="8" value="<?php echo($outboundTimes["field9"]); ?>" name="ob9">
                        <label class="mdl-textfield__label" for="ob9"><?php echo($outboundFields['field9']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="ibNotes" rows="3" type="text" value="<?php echo($outboundTimes["notes"]); ?>" name="obnotes"><?php echo($outboundTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="ibNotes">Notes</label>
                    </div>
                </div>
                <div<?php if($sortData['otpFlag'] == 'n'){ ?> style=display:none <?php } ?>>
                    <h5>OTP:</h5>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input type="text" class="datepicker-here mdl-textfield__input" data-language='en' data-date-format='DD MM d' value="<?php echo($otpTimes["date"]);?>" name="dateOTP" id="dateOTP"readonly>
                        <label class="mdl-textfield__label" for="dateOTP">Date</label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" id="otp1" type="text" maxlength="8"  value="<?php echo($otpTimes["field1"]); ?>" name="otp1">
                        <label class="mdl-textfield__label" for="otp1"><?php echo($otpFields['field1']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field2']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp2" type="text" maxlength="8"  value="<?php echo($otpTimes["field2"]); ?>" name="otp2">
                        <label class="mdl-textfield__label" for="otp2"><?php echo($otpFields['field2']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field3']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp3" type="text" maxlength="8"  value="<?php echo($otpTimes["field3"]); ?>" name="otp3">
                        <label class="mdl-textfield__label" for="otp3"><?php echo($otpFields['field3']) ?></label>
                        <!--</br>-->                    
                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field4']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp4" type="text" maxlength="8"  value="<?php echo($otpTimes["field4"]); ?>" name="otp4">
                        <label class="mdl-textfield__label" for="otp4"><?php echo($otpFields['field4']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field5']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp5" type="text" maxlength="8" value="<?php echo($otpTimes["field5"]); ?>" name="otp5">
                        <label class="mdl-textfield__label" for="otp5"><?php echo($otpFields['field5']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field6']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp6" type="text" maxlength="8" value="<?php echo($otpTimes["field6"]); ?>" name="otp6">
                        <label class="mdl-textfield__label" for="otp6"><?php echo($otpFields['field6']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field7']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp7" type="text" maxlength="8" value="<?php echo($otpTimes["field7"]); ?>" name="otp7">
                        <label class="mdl-textfield__label" for="otp7"><?php echo($otpFields['field7']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field8']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp8" type="text" maxlength="8" value="<?php echo($otpTimes["field8"]); ?>" name="otp8">
                        <label class="mdl-textfield__label" for="otp8"><?php echo($otpFields['field8']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" <?php if(!$otpFields['field9']){ ?> style=display:none <?php } ?>>
                        <input class="mdl-textfield__input" id="otp9" type="text" maxlength="8" value="<?php echo($otpTimes["field9"]); ?>" name="otp9">
                        <label class="mdl-textfield__label" for="otp9"><?php echo($otpFields['field9']) ?></label>
                        <!--</br>-->
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" id="ibNotes" rows="3" type="text" value="<?php echo($otpTimes["notes"]); ?>" name="otpnotes"><?php echo($otpTimes["notes"]); ?></textarea>
                        <label class="mdl-textfield__label" for="otpNotes">Notes</label>
                    </div>
                </div>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin: auto;" type="submit" name="submit"
                value="Submit">Submit</button>
            </form>
    </div>
</body>


</html>
