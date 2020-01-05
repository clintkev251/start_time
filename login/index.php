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
        import {MDCTextField} from '@material/textfield';
        import {MDCLineRipple} from '@material/line-ripple';
        import {MDCFloatingLabel} from '@material/floating-label';

        const floatingLabel = new MDCFloatingLabel(document.querySelector('.mdc-floating-label'));
        const lineRipple = new MDCLineRipple(document.querySelector('.mdc-line-ripple'));
        const textField = new MDCTextField(document.querySelector('.mdc-text-field'));
        const buttonRipple = new MDCRipple(document.querySelector('.mdc-button'));
    </script>
    <meta name="theme-color" content="#0a00b6">
    <title>Start Time</title>
    <?php ; 
        $myFile = "admin/start.csv";
        $startOB = "admin/startOB.csv";
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
        @import "@material/floating-label/mdc-floating-label";
        h1,
        h2,
        h3 {
            font-family: "Roboto", "serif";
            text-align: Center;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        body {
            background-image: url("/img/background.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
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
                left: 50%;
                width: 100%;
                margin-left: -1px;
                margin-right: 100%;
                
            }
            body {
                background-size: auto;
            }
        }
    </style>
</head>
<body>
    <a class="mdc-button mdc-button--raised" href="/">Home</a>
    <div class="mdc-card">
        <h2>Admin Login</h2>
        <label class="mdc-text-field">
        <input type="text" class="mdc-text-field__input">
        <span class="mdc-floating-label">Hint Text</span>
        <div class="mdc-text-field__bottom-line"></div>
</label>
</div>
    </div>
</body>