<?php
/* Database credentials */
define('DB_SERVER', 'sql.start-time.com');
define('DB_USERNAME', 'start_login');
define('DB_PASSWORD', '_mMk_g!sHUF_XUb4uMcW');
define('DB_NAME', 'sobdstart_db');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
mysqli_query($link, "SET time_zone = 'US/Eastern';");


// Sort Options

// Basic config
$stationName = "SOBD";
$preloadFlag = true;
$outboundFlag = true;
$otpFlag = true;

// Preload fields

$preloadUnloadFlag = false;
$preloadVanlinesFlag = false;
$preloadPrimeFlag = true;
$preloadSmallsFlag = false;
$preloadStartFlag = true;

// Outbound fields

$outboundUnloadFlag = false;
$outboundVanlinesFlag = false;
$outboundPrimeFlag = true;
$outboundSmallsFlag = false;
$outboundStartFlag = true;

// OTP options

$otpUnloadFlag = false;
$otpVanlinesFlag = false;
$otpPrimeFlag = true;
$otpSmallsFlag = false;
$otpStartFlag = true;


?>