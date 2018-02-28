<?php
	

	@include "./func/conf.php";
	
	$received_username = mysqli_real_escape_string($con,$_POST['username']);
	$received_password = mysqli_real_escape_string($con,$_POST['password']);
	
	$query = "SELECT `password`,`username` FROM `user` WHERE `username` = '$received_username'";
	$run_query = mysqli_query($con,$query);
	$result = mysqli_fetch_assoc($run_query);
	$hashed = $result['password'];
	

	if (password_verify($received_password, $hashed)) {
		$logas = $result['username'];

		
		
		
		session_start();
		$_SESSION["logas"] = $logas;
		$_SESSION['last_see'] = time();
		session_write_close();
		
		echo "Login";
	}
	
	
	
	
	mysqli_close($con);
?>