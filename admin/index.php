<!DOCTYPE html>
<html>
    <head>
        <title>Start Time Administration</title>
        <?php
        $file = fopen("start.txt", "r");
        $lines = file("start.txt");
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
</style>        
    </head>
    <a href="http://start-time.com/">Home</a>
    <body>
    <div class="bg-image"></div>
        <div class="bg-text">
        <h2>Edit the following fields below:</h2>
            <form method="post" action="index.php">
                Date: <input type="text" value ="<?php echo($lines[0]);?>" name="date"></br></br>
                Prime: <input type="text" value="<?php echo($lines[1]);?>" text = "test" name="prime"></br></br>
                Start: <input type="text" value="<?php echo($lines[2]);?>"  name="start"></br></br>
                Notes: <input type="text" value="<?php echo($lines[3]);?>" name="notes"></br></br>
                <input type="submit" name="submit" value="Save">
            </form>
    </body>
</html>
<?php
if(isset($_POST['submit'])){
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
    header("Location:https://start-time.com");
}
?>
