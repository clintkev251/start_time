<!DOCTYPE html>
<html>
    <head>
        <title>Start Time</title>
        <!-- TODO: Selectable day?? -->
        <?php ; 
        $datetime = new DateTime('tomorrow');
        //$tomorrow = $datetime->format('m-d-Y');
        $myFile = "admin/start.txt";
        $startOB = "admin/startOB.txt";
        $lines = file($myFile);
        $linesOB = file($startOB);
        $tomorrow = $lines[0];
        ?>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
  background-image: url("https://farm5.staticflickr.com/4888/32040173048_b4a45010a0_z_d.jpg");
  
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
</style>

    </head>
    <a href="/admin/">Admin</a>
    <body>
        <div class="bg-image"></div>
        <div class="bg-text">
        <h2 style="text-align:center;">Preload start time for <?php echo($tomorrow);?></h2>
        <h3 style="text-align:center">Prime: <?php echo($lines[1]);?>AM</h3>
        <h3 style="text-align:center">Start: <?php echo($lines[2]);?> AM</h3>
        <h3 style="text-align:center"><?php echo($lines[3]);?>
        <h2 style="text-align:center;">Preload start time for <?php echo($tomorrow);?></h2>
        <h3 style="text-align:center">Prime: <?php echo($lines[1]);?>AM</h3>
        <h3 style="text-align:center">Start: <?php echo($lines[2]);?> AM</h3>
        <h3 style="text-align:center"><?php echo($lines[3]);?>            
        </div>
    </body>
    
</html>


