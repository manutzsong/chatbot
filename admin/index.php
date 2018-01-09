<?php



session_start();
if ($_SESSION["logas"]) {
	header("Location: landing.php");
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<link rel="stylesheet" href="mycss.css">
    <title>Hello, world!</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	
	<script>
	
	$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'check_login.php',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data == 'Login') {
            window.location = 'landing.php';
          }
          else {
            alert('Invalid Credentials');
          }
       }
   });
 });
});
</script>
<script>
function background() {
	document.getElementById("wowawesome").style.backgroundImage = "url('https://source.unsplash.com/featured/1600x900/?nature,traffic,city,street')";
	
}
</script>

  </head>
  
  <body data-spy="scroll" data-target=".navbar" data-offset="50" >

  
  
<div class="parallax">
  

  
 <div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">

		<form class="boxme2" id="loginform">
			<div class="row">
				
				<div class="col-9">
				  <div class="form-group row">
					<label for="staticEmail" class="col-sm-4 col-form-label"><span style="color:white">Username</span></label>
					<div class="col-sm-8">
					  <input name="username" placeholder="Username" type="text" class="form-control">
					</div>
				  </div>
				  <div class="form-group row">
					<label for="inputPassword" class="col-sm-4 col-form-label"><span style="color:white">Password</span></label>
					<div class="col-sm-8">
					
					   <input name="password" placeholder="Password" type="password" class="form-control">
					
					</div>
				  </div>
				  
				  </div>
				
		  <div class="col-2">
			<input type="submit" value="Login" class="btn btn-outline-secondary">
		  </div>
		  </div>
		</form>
  </div>
</div> 
</div>  
  
  
  
  
  
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
</html>