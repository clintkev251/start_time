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
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta name="theme-color" content="#0a00b6">
    <title>CADI Start</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="styles.css" type="text/css" />
</head>
<a class="mdc-button mdc-button--raised" href="/admin.php">Admin</a>

<body>

    <div class="mdc-card">
        <h2>Preload start time for
            <?php echo($preloadTimes["date"]);?>
        </h2>
        <?php if ($preloadTimes["prime"] != "\n"): ?>
        <h3>Prime:
            <?php echo($preloadTimes["prime"]);?>AM</h3>
        <?php endif ?>
        <h3>Start:
            <?php echo($preloadTimes["start"]);?> AM</h3>
        <?php if($preloadTimes["notes"] != "\n"): ?>
        <h3>
            <?php echo($preloadTimes["notes"]); ?>
        </h3>
        <?php endif ?>
    </div>
    <div class="mdc-card">
        <h2>Outbound start time for <?php echo($outboundTimes["date"]);?></h2>
        <?php if($outboundTimes["prime"] != "\n"): ?>
        <h3>Prime: <?php echo($outboundTimes["prime"]);?>PM</h3>
        <?php endif ?>
        <h3>Start: <?php echo($outboundTimes["start"]);?> PM</h3>
        <?php if($outboundTimes["notes"] !="\n"): ?>
        <h3>
        <?php echo($outboundTimes["notes"]);?>
        </h3>
        <?php endif ?>
    </div>
</body>

</html>