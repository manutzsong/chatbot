<?php



@include "./func/db.php";
session_start();
if (!$_SESSION["logas"]) {
	header("Location: index.php");
}


  


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
		reload_log();
		update_usage();

	 
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
					$('#s1').text('Online');
					$('#comeon2').css("background-color", "#4CAF50");
					$('#s1').css("background-color", "#4CAF50");
					$('#comeon2').css("color", "white");
					$('#s1').css("color", "white");
					
					$('#comeon3').text(result[3]);
					$('#comeon4').text(result[5]);
					$('#s2').text(result[3]);
					$('#s3').text(result[5]);
					
					$('#comeon3').css("color", "white");
					$('#comeon4').css("color", "#4CAF50");
					$('#s2').css("color", "black");
					$('#s3').css("color", "white");
					$('#s3').css("background-color", "#4CAF50");
					
				}
				else {
					
					$('#comeon2').text('Offline');
					$('#comeon2').css("background-color", "red");
					$('#comeon2').css("color", "white");
					$('#comeon4').css("color", "red");
					
					$('#s1').text('Offline');
					$('#s1').css("background-color", "red");
					$('#s1').css("color", "white");
					$('#s1').css("color", "red");
						
				}
				

            },
        });
		
}

function start_server() {
	
	$.ajax({
            type: 'POST',
            url: './func/run_cmd.php',
            
            //dataType: 'json',
			beforeSend: function() {
				$('#s1').css("background-color", "white");
				$('#s1').html('<img class="img_spin" src="Ellipsis.gif">');
				
				$('#s2').css("background-color", "white");
				$('#s2').html('<img class="img_spin" src="Ellipsis.gif">');
				
				$('#s3').css("background-color", "white");
				$('#s3').html('<img class="img_spin" src="Ellipsis.gif">');
                
            },
            
            success: function(result) {
                //$('#comeon1').text(result[0]);
				if (result == 'work') {
					show_status();
					reload_log();
					
				}
				else {
					show_status();
					reload_log();

						
				}
				

            },
        });
		
}
function stop_server() {
	
	$.ajax({
            type: 'POST',
            url: './func/stop_cmd.php',
            
            //dataType: 'json',
			beforeSend: function() {
				$('#s1').css("background-color", "white");
				$('#s1').html('<img class="img_spin" src="Ellipsis.gif">');
				
				$('#s2').css("background-color", "white");
				$('#s2').html('<img class="img_spin" src="Ellipsis.gif">');
				
				$('#s3').css("background-color", "white");
				$('#s3').html('<img class="img_spin" src="Ellipsis.gif">');
                
            },
            
            success: function(result) {
                //$('#comeon1').text(result[0]);
				if (result == 'work') {
					show_status();
					reload_log();
					
				}
				else {
					show_status();
					reload_log();

						
				}
				

            },
        });
		
}
function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

function reload_log() {
	
	$.ajax({
            type: 'POST',
            url: './func/get_detail.php',
            
            //dataType: 'json',
			beforeSend: function() {
				
                
            },
            
            success: function(data) {
                var convert = nl2br(data);
				$('#log').html(data);

            },
        });
		
}

function uptime() {
	
	$.ajax({
            type: 'POST',
            url: './func/get_uptime.php',
            
            //dataType: 'json',
			beforeSend: function() {
				
                
            },
            
            success: function(data) {
                
				$('#r3').text(data);

            },
        });
		
}
function update_usage() {
	
	$.ajax({
            type: 'POST',
            url: './func/get_mem.php',
            
            dataType: 'json',
			beforeSend: function() {
				
                
            },
            
            success: function(result) {
				//console.log(result[0]);
                $('#r1').text(result[0]);
				$('#r2').text(result[1]);
				$('#r4').text(result[2]);
				$('#r5').text(result[3]);

            },
        });
		
}
</script>
  </head>
  
  <body data-spy="scroll" data-target=".navbar" data-offset="50" onload="show_status();reload_log();uptime();update_usage();refresh();refresh1sec();">
	
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

		<div id="server"></div>
		<div class="boxme">
		<div class="row">
			<div class="col-md-2">
				<h4>Server Information</h4>
			</div>
			<div class="col-md-8">
				<h6>Chatbot Status : <span id="s1">Undefined</span></h6>
				<h6>Chatbot  PID : <span id="s2">Undefined</span></h6>
				<h6>Chatbot  Uptime : <span id="s3">Undefined</span></h6>	
				<br><br>
				<h6>Server Memory Usage : <span id="r1"></span></h6>	
				<h6>Server CPU Usage : <span id="r2"></span></h6>	
				<h6>Server Uptime : <span id="r3">Undefined</span></h6>	
				
				<h6>Server Space Available : <span id="r4"></span></h6>	
				<h6>Server Space Total : <span id="r5"></span></h6>	
				<br><br>
				<h6>Server Log : </h6>
				<br>
				<br>
				<div id="log" class="pre-scrollable2">
					
				</div>
				
				
			</div>
			<div class="col-md-2"><h6>Server Control</h6>

				<button class="btn btn-success btn-block" onClick="start_server();">Start</button>
				<button class="btn btn-danger btn-block" data-toggle="modal" data-target="#stop_modal">Stop</button>
				
			</div>
			</div>
		</div>

		
	</div>
	<br><br><br><br><br>
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

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
</html>