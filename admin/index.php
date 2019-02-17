<!DOCTYPE html>
<html>
    <head>
        <title>Start Time Administration</title>
        <?php
        $file = fopen("start.txt", "r");
        $lines = file("start.txt");
        $fileOB = fopen("startOB.txt", "r");
        $linesOB = file("startOB.txt");
        ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-image {
  /* The image used */
  background-image: url("6UaXRIr.jpg");
  
  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  font-family: 'Roboto', sans-serif;
  color: white;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 80%;
  padding: 20px;
  text-align: center;
}

.myButton {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #c74545), color-stop(1, #bd402a));
	background:-moz-linear-gradient(top, #c74545 5%, #bd402a 100%);
	background:-webkit-linear-gradient(top, #c74545 5%, #bd402a 100%);
	background:-o-linear-gradient(top, #c74545 5%, #bd402a 100%);
	background:-ms-linear-gradient(top, #c74545 5%, #bd402a 100%);
	background:linear-gradient(to bottom, #c74545 5%, #bd402a 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c74545', endColorstr='#bd402a',GradientType=0);
	background-color:#c74545;
	-moz-border-radius:9px;
	-webkit-border-radius:9px;
	border-radius:9px;
	border:1px solid #ab1e19;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;
	padding:7px 7px;
	text-decoration:none;
	text-shadow:0px 1px 0px #662828;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bd402a), color-stop(1, #c74545));
	background:-moz-linear-gradient(top, #bd402a 5%, #c74545 100%);
	background:-webkit-linear-gradient(top, #bd402a 5%, #c74545 100%);
	background:-o-linear-gradient(top, #bd402a 5%, #c74545 100%);
	background:-ms-linear-gradient(top, #bd402a 5%, #c74545 100%);
	background:linear-gradient(to bottom, #bd402a 5%, #c74545 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bd402a', endColorstr='#c74545',GradientType=0);
	background-color:#bd402a;
}
.myButton:active {
	position:relative;
	top:1px;
}    
</style>        
    </head>
    <a href="/" class="myButton">Home</a>
    <body>
    <div class="bg-image"></div>
        <div class="bg-text">
        <h2>Edit the following fields below:</h2>
            <form method="post" action="index.php" autocomplete="off">
            <h3>Preload:</h3>
                Date: <input type="text" value ="<?php echo($lines[0]);?>" name="date"></br></br>
                Prime: <input type="text" value="<?php echo($lines[1]);?>" text = "test" name="prime"></br></br>
                Start: <input type="text" value="<?php echo($lines[2]);?>"  name="start"></br></br>
                Notes: <input type="text" value="<?php echo($lines[3]);?>" name="notes"></br></br>
            <h3>Outbound:</h3>
                Date: <input type="text" value ="<?php echo($linesOB[0]);?>" name="dateOB"></br></br>
                Prime: <input type="text" value="<?php echo($linesOB[1]);?>" name="primeOB"></br></br>
                Start: <input type="text" value="<?php echo($linesOB[2]);?>"  name="startOB"></br></br>
                Notes: <input type="text" value="<?php echo($linesOB[3]);?>" name="notesOB"></br></br>
                <input type="submit" name="submit" value="Save">
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
    $to_write[2] = $_POST['startOB'];
    $to_write[3] = $_POST['notesOB'];
    $i = 0;
    while($i < count($to_write)){
        fwrite($myfile, $to_write[$i]);
        fwrite($myfile, "\n");
        $i++;
    }
    fclose($myfile);
    #header("Location:https://start-time.com");
}
?>
