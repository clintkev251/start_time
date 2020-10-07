<?php 
require_once "config.php";


$stationNumber = null;
if (isset($_POST["sel"])) {
    $expire = time() + 60 * 60 * 24 * 1;
    setcookie("stationEditor", $_POST["sel"], $expire);
    header("location: " . $_SERVER["PHP_SELF"]);
} else if (isset($_COOKIE["stationEditor"])) {
    $stationNumber = $_COOKIE["stationEditor"];
}
include("head.php");
$sql = mysqli_query($link, "SELECT * FROM stations WHERE stationNumber = $stationNumber");
$sortData = mysqli_fetch_assoc($sql);
$sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE stationNumber = $stationNumber AND sort = 'Preload'");
$preloadFields = mysqli_fetch_assoc($sql);
$sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE stationNumber = $stationNumber AND sort = 'Outbound'");
$outboundFields = mysqli_fetch_assoc($sql);
$sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE stationNumber = $stationNumber AND sort = 'OTP'");
$otpFields = mysqli_fetch_assoc($sql);

// Set field varriables for database update

if(isset($_POST['submit'])){

    $setStationNum = trim($_POST["stationNum"]);
    setcookie("stationEditor", $setStationNum, $expire);
    $stationFriendly = trim($_POST["stationName"]);
    $stationAlpha = trim($_POST["stationAlpha"]);
    
    if($_POST['preload'] == 'y'){
        $preloadFlag = 'y';
    }
    else{
        $preloadFlag = 'n';
    }
    if($_POST['outbound'] == 'y'){
        $outboundFlag = 'y';
    }
    else{
        $outboundFlag = 'n';
    }
    if($_POST['otp'] == 'y'){
        $otpFlag = 'y';
    }
    else{
        $otpFlag = 'n';
    }
    $ib1 = trim($_POST["ib1"]);
    $ib2 = trim($_POST["ib2"]);
    $ib3 = trim($_POST["ib3"]);
    $ib4 = trim($_POST["ib4"]);
    $ib5 = trim($_POST["ib5"]);
    $ib6 = trim($_POST["ib6"]);
    $ib7 = trim($_POST["ib7"]);
    $ib8 = trim($_POST["ib8"]);
    $ib9 = trim($_POST["ib9"]);
    
    $ob1 = trim($_POST["ob1"]);
    $ob2 = trim($_POST["ob2"]);
    $ob3 = trim($_POST["ob3"]);
    $ob4 = trim($_POST["ob4"]);
    $ob5 = trim($_POST["ob5"]);
    $ob6 = trim($_POST["ob6"]);
    $ob7 = trim($_POST["ob7"]);
    $ob8 = trim($_POST["ob8"]);
    $ob9 = trim($_POST["ob9"]);
    
    $otp1 = trim($_POST["otp1"]);
    $otp2 = trim($_POST["otp2"]);
    $otp3 = trim($_POST["otp3"]);
    $otp4 = trim($_POST["otp4"]);
    $otp5 = trim($_POST["otp5"]);
    $otp6 = trim($_POST["otp6"]);
    $otp7 = trim($_POST["otp7"]);
    $otp8 = trim($_POST["otp8"]);
    $otp9 = trim($_POST["otp9"]);
    
    $preload = "Preload";
    $outbound = "Outbound";
    $otp = "OTP";
    
    // Prepare and execute sql statements
    
    if($stationNumber == 'new'){
        $sql = "INSERT INTO stations (stationNumber) VALUES (stationNumber = ?)";
        // var_dump($setStationNum);die();
        // Generate entry for new station entry in stations table
        if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $setStationNum);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        }
        
        // Generate empty field legend entries for new station
        
        mysqli_query($link,"INSERT INTO fieldLegend(stationNumber, sort) VALUES('$setStationNum', 'Preload')");
        mysqli_query($link,"INSERT INTO fieldLegend(stationNumber, sort) VALUES('$setStationNum', 'Outbound')");
        mysqli_query($link,"INSERT INTO fieldLegend(stationNumber, sort) VALUES('$setStationNum', 'OTP')");

        
        
        // Generate empty entries for new station in times table
       
        mysqli_query($link,"INSERT INTO times(stationNumber, sort) VALUES('$setStationNum', 'Preload')");
        mysqli_query($link,"INSERT INTO times(stationNumber, sort) VALUES('$setStationNum', 'Outbound')");
        mysqli_query($link,"INSERT INTO times(stationNumber, sort) VALUES('$setStationNum', 'OTP')");
    }

    
    $sql = "UPDATE stations SET stationAlpha = ?, stationNumber = ?, stationFriendly = ?, preloadFlag = ?, outboundFlag = ?, otpFlag = ? WHERE stationNumber = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sissssi", $stationAlpha, $setStationNum, $stationFriendly, $preloadFlag, $outboundFlag, $otpFlag, $stationNumber);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    $sql = "UPDATE fieldLegend SET field1 = ?, field2 = ?, field3 = ?, field4 = ?, field5 = ?, field6 = ?, field7 = ?, field8 = ?, field9 = ?  WHERE stationNumber = ? AND sort = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sssssssssis", $ib1, $ib2, $ib3, $ib4, $ib5, $ib6, $ib7, $ib8, $ib9, $stationNumber, $preload);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sssssssssis", $ob1, $ob2, $ob3, $ob4, $ob5, $ob6, $ob7, $ob8, $ob9, $stationNumber, $outbound);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sssssssssis", $otp1, $otp2, $otp3, $otp4, $otp5, $otp6, $otp7, $otp8, $otp9, $stationNumber, $otp);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    echo "<meta http-equiv='refresh' content='0'>";

}
?>


<title>Station Editor</title>
<html>
    <style type="text/css">
    .mdl-textfield{padding-bottom: 24px;}
    .alert {
      padding: 20px;
      background-color: #f44336; /* Red */
      color: white;
      margin-bottom: 15px;
    }
    .col{
        column-count: 2;
  column-gap: 20px;
  -moz-column-count: 2;
  -webkit-column-count: 2;
        }
    </style>
    <body>
        <a href="admin.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Back</a>
            <div class="mdl-card">
                <?php $sql = mysqli_query($link, "SELECT * FROM stations"); ?>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                   <h5>Choose a station to be edited</h5> 
                   <select name="sel" size="1" onchange="this.form.submit();">
                            <option></option>
                            <option value = "new" <?php if($stationNumber === 'new'){?> selected <?php } ?>>Create New</option>
                        <?php while ($stationConfig = mysqli_fetch_assoc($sql)) { ?> 
                            <option value=<?php echo ($stationConfig['stationNumber']); if($stationConfig['stationNumber'] === $stationNumber){?> selected <?php } ?>><?php echo $stationConfig['stationAlpha']?>/<?php echo $stationConfig['stationNumber']?></option> 
                        <?php } ?>
                    </select>   
                </form>
                <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off" style="width: 50%; margin: auto; text-align: center;">
                    <div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" id="stationNum" type="text" maxlength="4"  value="<?php echo($sortData["stationNumber"]); ?>" name="stationNum">
                            <label class="mdl-textfield__label" for="stationNum">Station Number</label>
                            <!--</br>-->
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" id="stationAlpha" type="text" maxlength="4"  value="<?php echo($sortData["stationAlpha"]); ?>" name="stationAlpha">
                            <label class="mdl-textfield__label" for="stationAlpha">Station Alpha</label>
                            <!--</br>-->
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" id="stationName" type="text" maxlength="20"  value="<?php echo($sortData["stationFriendly"]); ?>" name="stationName">
                            <label class="mdl-textfield__label" for="stationName">Station Name</label>
                            <!--</br>-->
                        </div>
                        <div>
                            <h5>Sorts Run:</h5>
                                <div>
                                    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for='preload' >
                                    <input type="checkbox" name="preload" id='preload' value="y" class="mdl-switch__input" <?php if($sortData['preloadFlag'] == 'y'){echo 'checked' ;} ?>>
                                    <span class="mdl-switch__label">Preload</span>
                                </div>
                                <div>
                                    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for='outbound' >
                                    <input type="checkbox" name="outbound" id='outbound' value="y" class="mdl-switch__input"<?php if($sortData['outboundFlag'] == 'y'){echo 'checked' ;} ?>>
                                    <span class="mdl-switch__label">Outbound</span>
                                </div>
                                <div>
                                    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for='otp' >
                                    <input type="checkbox" name="otp" id='otp' value="y" class="mdl-switch__input" <?php if($sortData['otpFlag'] == 'y'){echo 'checked' ;} ?>>
                                    <span class="mdl-switch__label">OTP</span>
                                </div>
                                
                        </div>
                    </div>
                </div>
                <div class="mdl-card">
                        <h5>Field Editor</h5>
                        <p>Note: Date and notes fields are included automaticlly</p>
                        <h6>Preload</h6>
                        <div class='col'>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib1" type="text" maxlength="20"  value="<?php echo($preloadFields["field1"]); ?>" name="ib1">
                                <label class="mdl-textfield__label" for="ib1">Field 1</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib2" type="text" maxlength="20"  value="<?php echo($preloadFields["field2"]); ?>" name="ib2">
                                <label class="mdl-textfield__label" for="ib2">Field 2</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib3" type="text" maxlength="20"  value="<?php echo($preloadFields["field3"]); ?>" name="ib3">
                                <label class="mdl-textfield__label" for="ib3">Field 3</label>
                                <!--</br>-->                    
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib4" type="text" maxlength="20"  value="<?php echo($preloadFields["field4"]); ?>" name="ib4">
                                <label class="mdl-textfield__label" for="ib4">Field 4</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib5" type="text" maxlength="20" value="<?php echo($preloadFields["field5"]); ?>" name="ib5">
                                <label class="mdl-textfield__label" for="ib5">Field 5</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib6" type="text" maxlength="20" value="<?php echo($preloadFields["field6"]); ?>" name="ib6">
                                <label class="mdl-textfield__label" for="ib6">Field 6</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib7" type="text" maxlength="20" value="<?php echo($preloadFields["field7"]); ?>" name="ib7">
                                <label class="mdl-textfield__label" for="ib7">Field 7</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib8" type="text" maxlength="20" value="<?php echo($preloadFields["field8"]); ?>" name="ib8">
                                <label class="mdl-textfield__label" for="ib8">Field 8</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ib9" type="text" maxlength="20" value="<?php echo($preloadFields["field9"]); ?>" name="ib9">
                                <label class="mdl-textfield__label" for="ib9">Field 9</label>
                                <!--</br>-->
                            </div>
                        </div>
                        <h6>Outbound</h6>
                        <div class = 'col'>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob1" type="text" maxlength="20"  value="<?php echo($outboundFields["field1"]); ?>" name="ob1">
                                <label class="mdl-textfield__label" for="ob1">Field 1</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob2" type="text" maxlength="20"  value="<?php echo($outboundFields["field2"]); ?>" name="ob2">
                                <label class="mdl-textfield__label" for="ob2">Field 2</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob3" type="text" maxlength="20"  value="<?php echo($outboundFields["field3"]); ?>" name="ob3">
                                <label class="mdl-textfield__label" for="ob3">Field 3</label>
                                <!--</br>-->                    
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob4" type="text" maxlength="20"  value="<?php echo($outboundFields["field4"]); ?>" name="ob4">
                                <label class="mdl-textfield__label" for="ob4">Field 4</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob5" type="text" maxlength="20" value="<?php echo($outboundFields["field5"]); ?>" name="ob5">
                                <label class="mdl-textfield__label" for="ob5">Field 5</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob6" type="text" maxlength="20" value="<?php echo($outboundFields["field6"]); ?>" name="ob6">
                                <label class="mdl-textfield__label" for="ob6">Field 6</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob7" type="text" maxlength="20" value="<?php echo($outboundFields["field7"]); ?>" name="ob7">
                                <label class="mdl-textfield__label" for="ob7">Field 7</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob8" type="text" maxlength="20" value="<?php echo($outboundFields["field8"]); ?>" name="ob8">
                                <label class="mdl-textfield__label" for="ob8">Field 8</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="ob9" type="text" maxlength="20" value="<?php echo($outboundFields["field9"]); ?>" name="ob9">
                                <label class="mdl-textfield__label" for="ob9">Field 9</label>
                                <!--</br>-->
                            </div>
                        </div>
                        <h6>OTP</h6>
                        <div class = 'col'>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp1" type="text" maxlength="20"  value="<?php echo($otpFields["field1"]); ?>" name="otp1">
                                <label class="mdl-textfield__label" for="otp1">Field 1</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp2" type="text" maxlength="20"  value="<?php echo($otpFields["field2"]); ?>" name="otp2">
                                <label class="mdl-textfield__label" for="otp2">Field 2</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp3" type="text" maxlength="20"  value="<?php echo($otpFields["field3"]); ?>" name="otp3">
                                <label class="mdl-textfield__label" for="otp3">Field 3</label>
                                <!--</br>-->                    
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp4" type="text" maxlength="20"  value="<?php echo($otpFields["field4"]); ?>" name="otp4">
                                <label class="mdl-textfield__label" for="otp4">Field 4</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp5" type="text" maxlength="20" value="<?php echo($otpFields["field5"]); ?>" name="otp5">
                                <label class="mdl-textfield__label" for="otp5">Field 5</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp6" type="text" maxlength="20" value="<?php echo($otpFields["field6"]); ?>" name="otp6">
                                <label class="mdl-textfield__label" for="otp6">Field 6</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp7" type="text" maxlength="20" value="<?php echo($otpFields["field7"]); ?>" name="otp7">
                                <label class="mdl-textfield__label" for="otp7">Field 7</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp8" type="text" maxlength="20" value="<?php echo($otpFields["field8"]); ?>" name="otp8">
                                <label class="mdl-textfield__label" for="otp8">Field 8</label>
                                <!--</br>-->
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" id="otp9" type="text" maxlength="20" value="<?php echo($otpFields["field9"]); ?>" name="otp9">
                                <label class="mdl-textfield__label" for="otp9">Field 9</label>
                                <!--</br>-->
                            </div>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin: auto;" type="submit" name="submit"
                value="Submit">Submit</button>
                    </div>
            </div>
        </form>
    </body>
</html>