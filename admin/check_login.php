<?php
	

	@include "./func/conf.php";
	
	$received_username = mysqli_real_escape_string($con,$_POST['username']);
	$received_password = mysqli_real_escape_string($con,$_POST['password']);
	
	$query = "SELECT `username` FROM `user` WHERE `username` = '$received_username' AND `password` = '$received_password'";
	$run_query = mysqli_query($con,$query);
	$result = mysqli_fetch_assoc($run_query);
	if ($result == true) {

			$logas = $result['username'];

		
		
		
		session_start();
		$_SESSION["logas"] = $logas;
		$_SESSION['last_see'] = time();
		session_write_close();
		
		echo "Login";
		
		
		
		
		
	}
	
	
	
	mysqli_close($con);
?>