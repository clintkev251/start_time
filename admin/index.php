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
    <title>Start Time Administration</title>
    <?php
        $file = fopen("start.txt", "r");
        $lines = file("start.txt");
        $fileOB = fopen("startOB.txt", "r");
        $linesOB = file("startOB.txt");
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
            background-image: url("/admin/6UaXRIr.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        * {
            box-sizing: border-box;
        }

        .bg-image {
            /* The image used */
            background-image: url("6UaXRIr.jpg");
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
    </style>
</head>
<a href="/" class="mdc-button mdc-button--raised" style="margin: 0.5%;">Home</a>

<body>
    <div class="mdc-card">
        <h2>Edit the following fields below:</h2>
        <form method="post" action="index.php" autocomplete="off" style="width: 50%; margin: auto; text-align: center;">
            <h3>Preload:</h3>
            Date: <input type="text" value="<?php echo($lines[0]);?>" name="date"></br></br>
            Prime: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($lines[1]);?>" name="prime">
            AM</br></br>
            Start: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($lines[2]);?>" name="start">
            AM</br></br>
            Notes: <input type="text" value="<?php echo($lines[3]);?>" name="notes"></br></br>
            <h3>Outbound:</h3>
            Date: <input type="text" value="<?php echo($linesOB[0]);?>" name="dateOB"></br></br>
            Prime: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOB[1]);?>"
                name="primeOB"> PM</br></br>
            Vanline: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOB[2]);?>"
                name="vanlineOB"> PM</br></br>
            Smalls: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOB[3]);?>"
                name="smallsOB"> PM</br></br>
            Start: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($linesOB[4]);?>"
                name="startOB"> PM</br></br>
            Notes: <input type="text" value="<?php echo($linesOB[5]);?>" name="notesOB"></br></br>
            <button class="mdc-button mdc-button--raised" style="margin: auto;" type="submit" name="submit" value="Submit">Submit</button>
        </form>
    </div>
</body>

</html>
<?php
if(isset($_POST['submit'])){
    echo "<meta http-equiv='refresh' content='0'>";
    $myfile = fopen("start.txt", "w");
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
    $myfile = fopen("startOB.txt", "w");
    $to_write[0] = $_POST['dateOB'];
    $to_write[1] = $_POST['primeOB'];
    $to_write[2] = $_POST['vanlineOB'];
    $to_write[3] = $_POST['smallsOB'];
    $to_write[4] = $_POST['startOB'];
    $to_write[5] = $_POST['notesOB'];
    $i = 0;
    while($i < count($to_write)){
        fwrite($myfile, $to_write[$i]);
        fwrite($myfile, "\n");
        $i++;
    }
    fclose($myfile);
}
?>