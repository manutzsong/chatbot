<?php



@include "./func/conf.php";
session_start();
if (!$_SESSION["logas"]) {
	header("Location: index.php");
}
mysqli_set_charset($con,"utf8mb4");
//Top 10 Intent
$sql_intent = "SELECT * FROM `intent` ORDER BY `time` DESC LIMIT 10";
$result_intent = mysqli_query($con, $sql_intent);








?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="MIS Chatbot Control">
	<meta name="author" content="Purin Koettip">   
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<!-- My css -->
	<link rel="stylesheet" href="mycss.css">
	
    <title>Hello, world!</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({ trigger: "hover" });   
});

</script>
<script>

	
	

function logoutme() {$.ajax({
        type: 'POST',
        url: 'logout.php',
        data: {logout: '<?php echo $loged?>'},
        success: function (data) {
            if (data == 'outalready') {
				window.location = 'index.php';
          }
          else {
            alert('Something went wrong');
          }
            
        },
        error: console.log('it did not work'),
    })
}
</script>
<script>
function refresh() {
	 setInterval(function(){ 
	 
	         show_status();


	 
	 }, 10000);

}
function refresh1sec() {
	 setInterval(function(){ 
	 
		update_usage();

	 
	 }, 1000);

}
function show_status() {
	$('#logout_but').css("color", "black");
	$.ajax({
            type: 'POST',
            url: './func/get_status.php',
            
            dataType: 'json',
            
            success: function(result) {
                //$('#comeon1').text(result[0]);
				if (result[1] == 'RUNNING') {
					$('#comeon2').text('Online');

					$('#comeon2').css("background-color", "#4CAF50");

					$('#comeon2').css("color", "white");

					$('#comeon3').text(result[3]);
					$('#comeon4').text(result[5]);

					
					$('#comeon3').css("color", "white");
					$('#comeon4').css("color", "#4CAF50");

				}
				else {
					
					$('#comeon2').text('Offline');
					$('#comeon2').css("background-color", "red");
					$('#comeon2').css("color", "white");
					$('#comeon4').css("color", "red");
					
						
				}
				

            },
        });
		
}

</script>
  </head>
  
  <body data-spy="scroll" data-target=".navbar" data-offset="50" onload="show_status();google_chart1();reload_log();uptime();update_usage();refresh();refresh1sec();google_chart2();">
	
<div style="display:none"><img src="Ellipsis.gif"></div>

   
<nav class="navbar nav-link navbar-dark fixed-top navbar-expand-lg head">
  <a class="navbar-brand" href="landing.php">MIS Chatbot</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="user.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          User Info
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="user.php#topuser">Top Users</a>
          <a class="dropdown-item" href="user.php#recentregist">Recently Register</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user.php#groupmute">Group mute</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="intent.php#topintent">Top intents</a>
      </li>
      
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="server.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Manage Server
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="server.php#server">Chatbot Info</a>
		  <a class="dropdown-item" href="server.php#server">Start/Stop Chatbot</a>
		  
          <a class="dropdown-item" href="server.php#server">Server Info</a>
        </div>
      </li>
	  
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="analyze.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Analyze
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="analyze.php#traffic">Traffic</a>
		  <a class="dropdown-item" href="analyze.php#piechart">Intent Reply</a>
		  
          
        </div>
      </li>
	  
	  
	  

    </ul>
	


<ul class="nav navbar-nav mx-auto" href="#">	
	<li class="nav-item">  
			
				<span id="comeon1"></span> Status : <span id="comeon2">...</span> PID : <span id="comeon3">...</span> Uptime : <span id="comeon4">...</span>
			
	</li>
</ul>

    <ul class="nav navbar-nav navbar-right">
				<li class="nav-item" >
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logout_modal">
					  Logout
					</button>
				</li>
	</ul>
  </div>
</nav>


	<div id="topuser"></div>
	<div class="container" style="padding-top:5em;">
		
				
				
				
				
<div id="topintent" style="padding-top:2em;padding-bottom:2em;"></div>
<div class="boxme">
			<h4>Top 10 Intents</h4>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-3"><h6>Intent name</h6></div>
				<div class="col-md-3"><h6>Time reply</h6></div>
				<div class="col-md-2"><h6>Last reply</h6></div>
				<div class="col-md-2"></div>
			</div>

			<?php
				while($row_intent = mysqli_fetch_assoc($result_intent)) { 
					$intent_name = $row_intent['intent'];
					$intent_time = $row_intent['time'];
					$intent_id = $row_intent['intent_id'];
					$intent_lastsee = $row_intent['last_see'];
					
					echo "<div class='row'>
							<div class='col-md-2'></div>
							<div class='col-md-3'>
								
								
								
								<a href='#' onmouseover=\"

	var el = $(this);
    var _data = el.attr('alt');							
	$.ajax({
  type: 'POST',
  data: {intent_what: '$intent_id'},
  url: './func/what.php',
  dataType: 'json',
  success: function(data){
    el.attr('data-content', data);
    el.popover('show');
    
  }
});
\" data-toggle='popover' title='Intent Reply' data-content='Loading...' >$intent_name</a>
								
								
								
								
								
								
								
								
								
							</div>
							<div class='col-md-3'>
								$intent_time
							</div>
							<div class='col-md-2'>
								$intent_lastsee
							</div><div class='col-md-2'></div>
						  </div>"; 
					
				} ?></div>				
		
	</div>
	<br>
<!-- FREAKING MODAL -->

<!-- Button trigger modal -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="logout_modal" tabindex="-1" role="dialog" aria-labelledby="logout_modal_aria" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logout_modal_aria">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to logout ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Stay</button>
        <button type="button" class="btn btn-primary" onClick="logoutme()">Logout</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="stop_modal" tabindex="-1" role="dialog" aria-labelledby="stop_server" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stop_server">Stop Server ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to <span style="color:red">STOP</span> Chatbot server ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keep it running</button>
        <button type="button" class="btn btn-primary" onClick="stop_server();">Stop Server</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL -->	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
</html>