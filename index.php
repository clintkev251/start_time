<!DOCTYPE html>
<html lang="en">

<?php
require_once "config.php";
// Get existing data from database - Preload
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'preload'");
$preloadTimes = mysqli_fetch_assoc($sql);

// Outbound
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'outbound'");
$outboundTimes = mysqli_fetch_assoc($sql);

// OTP
// Outbound
$sql = mysqli_query($link, "SELECT * FROM times WHERE sort = 'otp'");
$otpTimes = mysqli_fetch_assoc($sql);

include "head.php";

?>


<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="admin.php">Admin</a>

<body>
    <?php if($preloadFlag){ ?>
        <div class="mdc-card">
            <h4>Preload start time for
                <?php echo($preloadTimes["date"]);?>
            </h4>
            <?php if ($preloadTimes["unload"] != ""): ?>
            <h6>Unload:
                <?php echo($preloadTimes["unload"]);?> </h6>
            <?php endif ?>
            <?php if($preloadTimes["vanlines"] != ""): ?>
            <h6>Vanlines: <?php echo($preloadTimes["vanlines"]);?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["prime"] != ""): ?>
            <h6>Prime:
                <?php echo($preloadTimes["prime"]);?> </h6>
            <?php endif ?>
            <?php if ($preloadTimes["smalls"] != ""): ?>
            <h6>Smalls:
                <?php echo($preloadTimes["smalls"]);?> </h6>
            <?php endif ?>
            <h6>Start:
                <?php echo($preloadTimes["start"]);?> </h6>
            <?php if($preloadTimes["notes"] != ""): ?>
            <h6>
                <?php echo($preloadTimes["notes"]); ?>
            </h6>
            <?php endif ?>
        </div>
    <?php }
    if($outboundFlag){ ?>
        <div class="mdc-card">
            <h4>Outbound start time for <?php echo($outboundTimes["date"]);?></h4>
            <?php if ($outboundTimes["unload"] != ""): ?>
            <h6>Unload:
                <?php echo($outboundTimes["unload"]);?> </h6>
            <?php endif ?>
            <?php if($outboundTimes["vanlines"] != ""): ?>
            <h6>Vanlines: <?php echo($outboundTimes["vanlines"]);?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["prime"] != ""): ?>
            <h6>Prime:
                <?php echo($outboundTimes["prime"]);?> </h6>
            <?php endif ?>
            <?php if ($outboundTimes["smalls"] != ""): ?>
            <h6>Smalls:
                <?php echo($outboundTimes["smalls"]);?> </h6>
            <?php endif ?>
            <h6>Start:
                <?php echo($outboundTimes["start"]);?> </h6>
            <?php if($outboundTimes["notes"] != ""): ?>
            <h6>
                <?php echo($outboundTimes["notes"]); ?>
            </h6>
            <?php endif ?>
        </div>
    <?php }
    if($otpFlag){ ?>
        <div class="mdc-card">
            <h4>OTP start time for <?php echo($otpTimes["date"]);?></h4>
            <?php if ($otpTimes["unload"] != ""): ?>
            <h6>Unload:
                <?php echo($otpTimes["unload"]);?> </h6>
            <?php endif ?>
            <?php if($otpTimes["vanlines"] != ""): ?>
            <h6>Vanlines: <?php echo($otpTimes["vanlines"]);?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["prime"] != ""): ?>
            <h6>Prime:
                <?php echo($otpTimes["prime"]);?> </h6>
            <?php endif ?>
            <?php if ($otpTimes["smalls"] != ""): ?>
            <h6>Smalls:
                <?php echo($otpTimes["smalls"]);?> </h6>
            <?php endif ?>
            <h6>Start:
                <?php echo($otpTimes["start"]);?> </h6>
            <?php if($otpTimes["notes"] != ""): ?>
            <h6>
                <?php echo($otpTimes["notes"]); ?>
            </h6>
            <?php endif ?>
        </div>
    <?php } ?>
</body>

</html>