<?php include "head.php";
require_once "config.php";
if (isset($_POST["sel"])) {
    $expire = time() + 60 * 60 * 24 * 360;
    setcookie("stationViewer", $_POST["sel"], $expire);
    header("location: " . $_SERVER["PHP_SELF"]);
} else if (isset($_COOKIE["stationViewer"])) {
    $stationNumber = $_COOKIE["stationViewer"];
}
?>

<html>
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="index.php">Back</a>
    <body>
        <div class="mdc-card">
           <?php $sql = mysqli_query($link, "SELECT * FROM stations"); ?>
           <h4>Select Your Location:</h4>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <select name="sel" size="1" onchange="this.form.submit();">
                        <option></option>
                    <?php while ($stationConfig = mysqli_fetch_assoc($sql)) { ?> 
                        <option value=<?php echo ($stationConfig['stationNumber']); if($stationConfig['stationNumber'] === $stationNumber){?> selected <?php } ?>><?php echo $stationConfig['stationNumber']?>/<?php echo $stationConfig['stationFriendly']?></option> 
                    <?php } ?>
                </select>
            </form>
        </div>
    </body>
</html>