<?php


	$serverName	  = "localhost";
	$userName	  = "root";
	$userPassword	  = "128029486";
	$dbName	  = "saveme";
	$con = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	
	$mysqli = $con;
	$mysqli->set_charset("utf8");
	
	if (mysqli_connect_errno())
	{
		echo "Database Connect Failed : " . mysqli_connect_error();
		exit();
	}
	
	
?>