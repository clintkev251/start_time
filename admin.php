<?php

// Initialize the session
session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
// Get existing data from database - Preload
$sql = mysqli_query($link, "SELECT start,prime,date,notes FROM times WHERE sort = 'preload'");
$preloadTimes = mysqli_fetch_assoc($sql);
$updatedBy = $_SESSION["username"];
// Outbound
$sql = mysqli_query($link, "SELECT start,prime,date,notes FROM times WHERE sort = 'outbound'");
$outboundTimes = mysqli_fetch_assoc($sql);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Set varibles for times
        $updatedBy = $_SESSION["username"];
    // Preload
        $preload = "preload";
        $preStart = trim($_POST["start"]);
        $prePrime = trim($_POST["prime"]);
        $preDate = trim($_POST["date"]);
        $preNotes = trim($_POST["notes"]);
    // Outbound
        $outbound = "outbound";
        $obStart = trim($_POST["startOB"]);
        $obPrime = trim($_POST["primeOB"]);
        $obDate = trim($_POST["dateOB"]);
        $obNotes = trim($_POST["notesOB"]);
    //Create hashes from new data to detect changes
        
    // Prepare a sql statement for Preload
        $sql = "UPDATE times SET start = ?, date = ?, prime = ?, notes = ?, updatedBy = ? WHERE sort = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssss", $preStart, $preDate, $prePrime, $preNotes, $updatedBy, $preload );
            mysqli_stmt_execute($stmt);
        }
        
    // Prepare a sql statement for outbound
        $sql = "UPDATE times SET start = ?, date = ?, prime = ?, notes = ?, updatedBy = ? WHERE sort = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "ssssss", $obStart, $obDate, $obPrime, $obNotes, $updatedBy, $outbound );
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="/cal/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="/cal/js/datepicker.min.js"></script>
    <meta name="theme-color" content="#0a00b6">

    <!-- Include English language -->
    <script src="/cal/js/i18n/datepicker.en.js"></script>
    <title>Start Time Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/styles.css" type="text/css" />
</head>
<a href="logout.php" class="mdc-button mdc-button--raised" style="margin: 0.5%;">Home</a>
<a href="register.php" class="mdc-button mdc-button--raised">Add a user</a>
<a href="reset-password.php" class="mdc-button mdc-button--raised">Change your password</a>

<body>
    <div class="mdc-card">
        <h2>Edit the following fields below:</h2>
        <h4>(Fields in <i>italics</i> are optional)</h4>
        <form "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off" style="width: 50%; margin: auto; text-align: center;">
            <h3>Preload:</h3>
            Date: <input type="text" class="datepicker-here" data-language='en' data-date-format='DD MM d' value="<?php echo($preloadTimes["date"]);?>" name="date" readonly></br></br>
            <i>Prime:</i> <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($preloadTimes["prime"]);?>" name="prime">
            AM</br></br>
            Start: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($preloadTimes["start"]);?>" name="start">
            AM</br></br>
            <i>Notes:</i> <input type="text" value="<?php echo($preloadTimes["notes"]);?>" name="notes"></br></br>
            <h3>Outbound:</h3>
            Date: <input type="text" class="datepicker-here" data-language='en' data-date-format='DD MM d' value="<?php echo($outboundTimes["date"]);?>" name="dateOB"readonly></br></br>
            <i>Prime:</i> <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($outboundTimes["prime"]);?>"
                name="primeOB"> PM</br></br>
            Start: <input type="text" maxlength="5" style="width: 130px;" value="<?php echo($outboundTimes["start"]);?>"
                name="startOB"> PM</br></br>
            <i>Notes:</i> <input type="text" value="<?php echo($outboundTimes["notes"]);?>" name="notesOB"></br></br>
            <button class="mdc-button mdc-button--raised" style="margin: auto;" type="submit" name="submit"
                value="Submit">Submit</button>
        </form>
    </div>
</body>

</html>
