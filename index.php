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

include "head.php";

?>


<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="admin.php">Admin</a>

<body>
    <div class="mdc-card">
        <h4>Preload start time for
            <?php echo($preloadTimes["date"]);?>
        </h4>
        <?php if ($preloadTimes["unload"] != ""): ?>
        <h6>Unload:
            <?php echo($preloadTimes["unload"]);?> AM</h6>
        <?php endif ?>
        <?php if ($preloadTimes["prime"] != ""): ?>
        <h6>Prime:
            <?php echo($preloadTimes["prime"]);?> AM</h6>
        <?php endif ?>
        <?php if ($preloadTimes["smalls"] != ""): ?>
        <h6>Smalls:
            <?php echo($preloadTimes["smalls"]);?> AM</h6>
        <?php endif ?>
        <h6>Start:
            <?php echo($preloadTimes["start"]);?> AM</h6>
        <?php if($preloadTimes["notes"] != ""): ?>
        <h6>
            <?php echo($preloadTimes["notes"]); ?>
        </h6>
        <?php endif ?>
    </div>
    <div class="mdc-card">
        <h4>Outbound start time for <?php echo($outboundTimes["date"]);?></h4>
        <?php if($outboundTimes["prime"] != ""): ?>
        <h6>Prime: <?php echo($outboundTimes["prime"]);?> PM</h6>
        <?php endif ?>
        <?php if($outboundTimes["vanlines"] != ""): ?>
        <h6>Vanlines: <?php echo($outboundTimes["vanlines"]);?> PM</h6>
        <?php endif ?>
        <?php if($outboundTimes["smalls"] != ""): ?>
        <h6>Smalls: <?php echo($outboundTimes["smalls"]);?> PM</h6>
        <?php endif ?>
        <h6>Start: <?php echo($outboundTimes["start"]);?> PM</h6>
        <?php if($outboundTimes["notes"] !=""): ?>
        <h6>
        <?php echo($outboundTimes["notes"]);?>
        </h6>
        <?php endif ?>
    </div>
</body>

</html>