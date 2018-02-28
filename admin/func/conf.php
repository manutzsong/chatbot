<?php

$host_ssh = 'songpurin.me';
$user_ssh = 'root';
$pw_ssh = '128029486';

$serverName	  = "localhost";
$userName	  = "root";
$userPassword	  = "128029486";
$dbName	  = "saveme";
$con = mysqli_connect($serverName,$userName,$userPassword,$dbName);

$mysqli = $con;

mysqli_set_charset($con,"utf8mb4");

if (mysqli_connect_errno())
{
	echo "Database Connect Failed : " . mysqli_connect_error();
	exit();
}

$path = '/manutzsong/';



?>