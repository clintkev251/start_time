<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql.start-time.com');
define('DB_USERNAME', 'start_login');
define('DB_PASSWORD', '_mMk_g!sHUF_XUb4uMcW');
define('DB_NAME', 'start_nodelogin');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
mysqli_query($link, "SET time_zone = '-5:00';");
?>