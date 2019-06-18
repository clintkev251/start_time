<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script>
        import {
            MDCRipple
        } from '@material/ripple';

        const buttonRipple = new MDCRipple(document.querySelector('.mdc-button'));
    </script>
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
    <link rel="icon" type="image/png" sizes="192x192" href="/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <style>
        h2,
        h3 {
            font-family: "Roboto", "serif";
            text-align: "Center";
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        body {
            background-image: url("/img/background.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .mdc-card {
            margin: 2%;
            padding: 1%;
            display: flex;
            align-items: center;
            justify-content: center
        }
        }

        .mdc-button__label {
            font-family: "Roboto", "sarif";
        }


        @media (max-width: 490px) {
            .mdc-card {
                top: 50%;
                /* IMPORTANT */
                left: 50%;
                /* IMPORTANT */
                width: 100%;
                margin-left: -1px;
                /* HALF OF THE WIDTH */
                margin-right: 100%;
            }

            .bg-image {
                background-image: url("/img/background-mobile.png");
            }

        }
    </style>

</head>
<a class="mdc-button mdc-button--raised" href="/admin/">Admin</a>

<body>

    <div class="mdc-card">
        <h2>Preload start time for
            <?php echo($tomorrow);?>
        </h2>
        <?php if ($lines[1] != "\n"): ?>
        <h3>Prime/Unload:
            <?php echo($lines[1]);?>AM</h3>
        <?php endif ?>
        <h3>Start:
            <?php echo($lines[2]);?> AM</h3>
        <h3>
            <?php echo($lines[3]);?>
        </h3>
    </div>
    <div class="mdc-card">
        <h2>Outbound start time for <?php echo($linesOB[0]);?></h2>
        <?php if($linesOB[1] != "\n"): ?>
        <h3>Prime: <?php echo($linesOB[1]);?>PM</h3>
        <?php endif ?>
        <?php if($linesOB[2] != "\n"): ?>
        <h3>Vanlines: <?php echo($linesOB[2]);?>PM</h3>
        <?php endif ?>
        <?php if($linesOB[3] != "\n"): ?>
        <h3>Smalls: <?php echo($linesOB[3]);?>PM</h3>
        <?php endif ?>
        <h3>Start: <?php echo($linesOB[4]);?> PM</h3>
        <h3><?php echo($linesOB[5]);?>
    </div>
</body>

</html>