<?php

$host_ssh = 'xxxxxxxxxxxxxxxxxxxxx';
$user_ssh = 'xxxxxxxxx';
$pw_ssh = 'xxxxxx';

$serverName	  = "localhost";
$userName	  = "root";
$userPassword	  = "xxxxxxxxxx";
$dbName	  = "saveme";
$con = mysqli_connect($serverName,$userName,$userPassword,$dbName);

$mysqli = $con;
$con->set_charset("utf8");
mysqli_set_charset($con,"utf8mb4");

if (mysqli_connect_errno())
{
	echo "Database Connect Failed : " . mysqli_connect_error();
	exit();
}





?>
