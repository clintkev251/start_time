<!DOCTYPE html>
<html lang="en">

<head>
    <title>Start Time</title>
    <!-- TODO: Selectable day?? -->
    <?php ; 
        $myFile = "admin/start.txt";
        $startOB = "admin/startOB.txt";
        $lines = file($myFile);
        $linesOB = file($startOB);
        $tomorrow = $lines[0];
        ?>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .bg-image {
            /* The image used */
            background-image: url("/img/background.png");

            /* Add the blur effect */
            filter: blur(8px);
            -webkit-filter: blur(3px);

            /* Full height */
            height: 100%;



            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Position text in the middle of the page/image */
        .bg-text {
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/opacity/see-through */
            font-family: 'Roboto', sans-serif;
            color: white;
            font-size: 14px;
            font-weight: normal;
            border: 3px solid #f1f1f1;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
            padding: 1%;
            text-align: center;
        }

        .bg-textRel {
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/opacity/see-through */
            font-family: 'Roboto', sans-serif;
            color: white;
            font-size: 14px;
            font-weight: normal;
            border: 3px solid #f1f1f1;
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            width: 80%;
            padding: 1%;
            text-align: center;
        }

        .myButton {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #44c767), color-stop(1, #5cbf2a));
            background: -moz-linear-gradient(top, #44c767 5%, #5cbf2a 100%);
            background: -webkit-linear-gradient(top, #44c767 5%, #5cbf2a 100%);
            background: -o-linear-gradient(top, #44c767 5%, #5cbf2a 100%);
            background: -ms-linear-gradient(top, #44c767 5%, #5cbf2a 100%);
            background: linear-gradient(to bottom, #44c767 5%, #5cbf2a 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#44c767', endColorstr='#5cbf2a', GradientType=0);
            background-color: #44c767;
            -moz-border-radius: 9px;
            -webkit-border-radius: 9px;
            border-radius: 9px;
            border: 1px solid #18ab29;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-family: Arial;
            font-size: 12px;
            font-weight: bold;
            padding: 7px 7px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #2f6627;
            position: absolute;
            z-index: 1;
        }

        .myButton:hover {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #5cbf2a), color-stop(1, #44c767));
            background: -moz-linear-gradient(top, #5cbf2a 5%, #44c767 100%);
            background: -webkit-linear-gradient(top, #5cbf2a 5%, #44c767 100%);
            background: -o-linear-gradient(top, #5cbf2a 5%, #44c767 100%);
            background: -ms-linear-gradient(top, #5cbf2a 5%, #44c767 100%);
            background: linear-gradient(to bottom, #5cbf2a 5%, #44c767 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5cbf2a', endColorstr='#44c767', GradientType=0);
            background-color: #5cbf2a;
        }

        .myButton:active {
            position: absolute;
            z-index: 1;
        }

    </style>

</head>
<a href="/admin/" class="myButton">Admin</a>

<body>
    <div class="bg-image"></div>
    <div class="bg-text">
        <h2 style="text-align:center;">Preload start time for
            <?php echo($tomorrow);?>
        </h2>
        <?php if ($lines[1] != "\n"): ?>
        <h3 style="text-align:center">Prime:
            <?php echo($lines[1]);?>AM</h3>
        <?php endif ?>
        <h3 style="text-align:center">Start:
            <?php echo($lines[2]);?> AM</h3>
        <h3 style="text-align:center">
            <?php echo($lines[3]);?>
        </h3>
        </div>
        <div class="bg-textRel">
        <h2 style="text-align:center;">Outbound start time for <?php echo($linesOB[0]);?></h2>
        <?php if($linesOB[1] != "\n"): ?>
        <h3 style="text-align:center">Prime: <?php echo($linesOB[1]);?>PM</h3>
        <?php endif ?>
        <?php if($linesOB[2] != "\n"): ?>
        <h3 style="text-align:center">Vanlines: <?php echo($linesOB[2]);?>PM</h3>
        <?php endif ?>
        <?php if($linesOB[3] != "\n"): ?>
        <h3 style="text-align:center">Smalls: <?php echo($linesOB[3]);?>PM</h3>
        <?php endif ?>
        <h3 style="text-align:center">Start: <?php echo($linesOB[4]);?> PM</h3>
        <h3 style="text-align:center"><?php echo($linesOB[5]);?>     
    </div>
</body>

</html>
