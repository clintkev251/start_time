<!DOCTYPE html>
<html>

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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="/cal/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="/cal/js/datepicker.min.js"></script>
    <meta name="theme-color" content="#0a00b6">

    <!-- Include English language -->
    <script src="/cal/js/i18n/datepicker.en.js"></script>
    <title>Start Time Administration</title>
    <?php
        $file = fopen("start.csv", "r");
        $lines = file("start.csv");
        $fileOB = fopen("startOB.csv", "r");
        $linesOB = file("startOB.csv");
        $fileOTP = fopen("startOTP.csv", "r");
        $linesOTP = file("startOTP.csv");
        ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: "Roboto", "serif";
        }

        h2,
        h3 {
            font-family: "Roboto", "serif"
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        body {
            background-image: url("/img/background.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        * {
            box-sizing: border-box;
        }
        
        .bg-image {
            /* The image used */
            /*TODO: Change to something SOBD related */background-image: url("6UaXRIr.jpg");
            filter: blur(8px);
            -webkit-filter: blur(3px);
            background-attachment: fixed
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
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<a href="/" class="mdc-button mdc-button--raised" style="margin: 0.5%;">Home</a>

<body>
    <div class="mdc-card">
        <h2>Edit the following fields below:</h2>
        <h4>(Fields in <i>italics</i> are optional)</h4>
        <form method="post" action="index.php" autocomplete="off" style="width: 50%; margin: auto; text-align: center;">
            <h3>Preload:</h3>
            Date: <input type="text" class="datepicker-here" data-language='en' data-date-format='DD MM d' value="<?php echo($lines[0]);?>" name="date" readonly></br></br>
            <i>Prime:</i> <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($lines[1]);?>" name="prime"> AM</br></br>
            Start: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($lines[2]);?>" name="start"> AM</br></br>
            <i>Notes:</i> <input type="text" value="<?php echo($lines[3]);?>" name="notes"></br></br>
            <h3>Outbound:</h3>
            Date: <input type="text" class="datepicker-here" data-language='en' data-date-format='DD MM d' value="<?php echo($linesOB[0]);?>" name="dateOB"readonly></br></br>
            <i>Prime:</i> <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOB[1]);?>"name="primeOB"> PM</br></br>
            Start: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOB[2]);?>"name="startOB"> PM</br></br>
            <i>Notes:</i> <input type="text" value="<?php echo($linesOB[3]);?>" name="notesOB"></br></br>
            <h3>OTP:</h3>
            Date: <input type="text" class="datepicker-here" data-language='en' data-date-format='DD MM d' value="<?php echo($linesOTP[0]);?>" name="dateOTP"readonly></br></br>
            <i>Prime:</i> <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOTP[1]);?>"name="primeOTP"> PM</br></br>
            Start: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOTP[2]);?>"name="startOTP"> PM</br></br>
            <i>Notes:</i> <input type="text" value="<?php echo($linesOTP[3]);?>" name="notesOTP"></br></br>
            <button class="mdc-button mdc-button--raised" style="margin: auto;" type="submit" name="submit"
                value="Submit">Submit</button>
        </form>
    </div>
</body>

</html>
<?php
if(isset($_POST['submit'])){
    echo "<meta http-equiv='refresh' content='0'>";
    $myfile = fopen("start.csv", "w");
    $to_write[0] = $_POST['date'];
    $to_write[1] = $_POST['prime'];
    $to_write[2] = $_POST['start'];
    $to_write[3] = $_POST['notes'];
    $i = 0;
    while($i < count($to_write)){
        fwrite($myfile, $to_write[$i]);
        fwrite($myfile, "\n");
        $i++;
    }
    fclose($myfile);
    $myfile = fopen("startOB.csv", "w");
    $to_write[0] = $_POST['dateOB'];
    $to_write[1] = $_POST['primeOB'];
    $to_write[2] = $_POST['startOB'];
    $to_write[3] = $_POST['notesOB'];
    $i = 0;
    while($i < count($to_write)){
        fwrite($myfile, $to_write[$i]);
        fwrite($myfile, "\n");
        $i++;
    }
    fclose($myfile);
    $myfile = fopen("startOTP.csv", "w");
    $to_write[0] = $_POST['dateOTP'];
    $to_write[1] = $_POST['primeOTP'];
    $to_write[2] = $_POST['startOTP'];
    $to_write[3] = $_POST['notesOTP'];
    $i = 0;
    while($i < count($to_write)){
        fwrite($myfile, $to_write[$i]);
        fwrite($myfile, "\n");
        $i++;
    }
    fclose($myfile);
}
?>