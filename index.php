<?php

$stationNumber = null;

require_once "config.php";
if (isset($_COOKIE["stationViewer"])) {
    $stationNumber = $_COOKIE["stationViewer"];
}
else{
    header("location: select-station.php");
}

// Get existing data from database - Preload
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'Preload' AND stationNumber = $stationNumber");
$preloadTimes = mysqli_fetch_assoc($sql);

$sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE sort = 'Preload' AND stationNumber = $stationNumber");
$preloadFields = mysqli_fetch_assoc($sql);

// Outbound
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'Outbound' AND stationNumber = $stationNumber");
$outboundTimes = mysqli_fetch_assoc($sql);

$sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE sort = 'Outbound' AND stationNumber = $stationNumber");
$outboundFields = mysqli_fetch_assoc($sql);

// OTP
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'OTP' AND stationNumber = $stationNumber");
$otpTimes = mysqli_fetch_assoc($sql);

$sql = mysqli_query($link, "SELECT * FROM fieldLegend WHERE sort = 'OTP' AND stationNumber = $stationNumber");
$otpFields = mysqli_fetch_assoc($sql);


$sql = mysqli_query($link, "SELECT * FROM stations WHERE stationNumber = $stationNumber");
$stationConfig = mysqli_fetch_assoc($sql);

include "head.php";

?>


<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="admin.php">Admin</a>
<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="select-station.php">Change Location</a>

<body>
    <?php if($stationConfig['preloadFlag'] == 'y'){ ?>
        <div class="mdc-card">
            <h4>Preload start time for
                <?php echo($preloadTimes["date"]);?>
            </h4>
            <?php if ($preloadTimes["field1"] != ""): ?>
            <h6><?php echo $preloadFields["field1"] , ": ", $preloadTimes["field1"];?> </h6>
            <?php endif ?>
            <?php if($preloadTimes["field2"] != ""): ?>
            <h6><?php echo $preloadFields['field2'] , ": " , $preloadTimes["field2"];?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["field3"] != ""): ?>
            <h6><?php echo $preloadFields['field3'] , ": "  , $preloadTimes["field3"];?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["field4"] != ""): ?>
            <h6> <?php echo $preloadFields["field4"] , ": " , $preloadTimes["field4"];?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["field5"] != ""): ?>
            <h6> <?php echo $preloadFields["field5"] , ": " , $preloadTimes["field5"];?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["field6"] != ""): ?>
            <h6> <?php echo $preloadFields["field6"] , ": " , $preloadTimes["field6"];?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["field7"] != ""): ?>
            <h6> <?php echo $preloadFields["field7"] , ": " , $preloadTimes["field7"];?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["field8"] != ""): ?>
            <h6> <?php echo $preloadFields["field8"] , ": " , $preloadTimes["field8"];?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["field9"] != ""): ?>
            <h6> <?php echo $preloadFields["field9"] , ": " , $preloadTimes["field9"];?> </h6>
            <?php endif ?>
            <?php if($preloadTimes["notes"] != ""): ?>
            <h6><?php echo($preloadTimes["notes"]); ?></h6>
            <?php endif ?>
        </div>
    <?php }
    if($stationConfig['outboundFlag']=='y'){ ?>
        <div class="mdc-card">
            <h4>Outbound start time for     
            <?php echo($outboundTimes["date"]);?>
            </h4>
            <?php if ($outboundTimes["field1"] != ""): ?>
            <h6><?php echo $outboundFields["field1"] , ": ", $outboundTimes["field1"];?> </h6>
            <?php endif ?>
            <?php if($outboundTimes["field2"] != ""): ?>
            <h6><?php echo $outboundFields['field2'] , ": " , $outboundTimes["field2"];?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["field3"] != ""): ?>
            <h6><?php echo $outboundFields['field3'] , ": "  , $outboundTimes["field3"];?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["field4"] != ""): ?>
            <h6> <?php echo $outboundFields["field4"] , ": " , $outboundTimes["field4"];?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["field5"] != ""): ?>
            <h6> <?php echo $outboundFields["field5"] , ": " , $outboundTimes["field5"];?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["field6"] != ""): ?>
            <h6> <?php echo $outboundFields["field6"] , ": " , $outboundTimes["field6"];?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["field7"] != ""): ?>
            <h6> <?php echo $outboundFields["field7"] , ": " , $outboundTimes["field7"];?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["field8"] != ""): ?>
            <h6> <?php echo $outboundFields["field8"] , ": " , $outboundTimes["field8"];?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["field9"] != ""): ?>
            <h6> <?php echo $outboundFields["field9"] , ": " , $outboundTimes["field9"];?> </h6>
            <?php endif ?>
            <?php if($outboundTimes["notes"] != ""): ?>
            <h6><?php echo($outboundTimes["notes"]); ?></h6>
            <?php endif ?>
            </div>
    <?php }
    if($stationConfig['otpFlag'] == 'y'){ ?>
        <div class="mdc-card">
            <h4>OTP start time for
            <?php echo($otpTimes["date"]);?>
            </h4>
            <?php if ($otpTimes["field1"] != ""): ?>
            <h6><?php echo $otpFields["field1"] , ": ", $otpTimes["field1"];?> </h6>
            <?php endif ?>
            <?php if($otpTimes["field2"] != ""): ?>
            <h6><?php echo $otpFields['field2'] , ": " , $otpTimes["field2"];?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["field3"] != ""): ?>
            <h6><?php echo $otpFields['field3'] , ": "  , $otpTimes["field3"];?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["field4"] != ""): ?>
            <h6> <?php echo $otpFields["field4"] , ": " , $otpTimes["field4"];?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["field5"] != ""): ?>
            <h6> <?php echo $otpFields["field5"] , ": " , $otpTimes["field5"];?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["field6"] != ""): ?>
            <h6> <?php echo $otpFields["field6"] , ": " , $otpTimes["field6"];?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["field7"] != ""): ?>
            <h6> <?php echo $otpFields["field7"] , ": " , $otpTimes["field7"];?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["field8"] != ""): ?>
            <h6> <?php echo $otpFields["field8"] , ": " , $otpTimes["field8"];?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["field9"] != ""): ?>
            <h6> <?php echo $otpFields["field9"] , ": " , $otpTimes["field9"];?> </h6>
            <?php endif ?>
            <?php if($otpTimes["notes"] != ""): ?>
            <h6><?php echo($otpTimes["notes"]); ?></h6>
            <?php endif ?>
            </div>
    <?php } ?>
</body>
</html>