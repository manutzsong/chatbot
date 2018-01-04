<?php



@include "db.php";
session_start();
if (!$_SESSION["logas"]) {
	header("Location: index.php");
}


$sqlmute = "select * from mute";
$resultmute = mysqli_query($con, $sqlmute);


 
$sql_line = "SELECT id, DATE_FORMAT(date, '%Y,%l,%d') AS 'date', count_traffic FROM traffic";
$result_line = mysqli_query($con, $sql_line);

//Order Top 10

$sql_top10 = "SELECT * FROM `most` ORDER BY `time_usage` DESC LIMIT 10";
$result_top10 = mysqli_query($con, $sql_top10);

//Top 10 Intent
$sql_intent = "SELECT * FROM `intent` ORDER BY `time` DESC LIMIT 10";
$result_intent = mysqli_query($con, $sql_intent);


//Register Upload

$sql_reg = "SELECT * FROM `register` ORDER BY `register`.`date_create` DESC LIMIT 10";
$result_reg = mysqli_query($con, $sql_reg);



//Byte func


	
	
	$bytes = disk_free_space("."); 
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    //echo $bytes . '<br />';
    //echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
  
  
  
  
  
 //Server relate

function get_server_memory_usage(){

    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = $mem[2]/$mem[1]*100;
	
    return $memory_usage;
} 
  
function get_server_cpu_usage(){

    $load = sys_getloadavg();
    return $load[0];

}  


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<!-- My css -->
	<link rel="stylesheet" href="mycss.css">
	
    <title>Hello, world!</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	function google_chart1() {

		  google.charts.load('current', {'packages':['line']});
		  google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

		  var data = new google.visualization.DataTable();
		  data.addColumn('date', 'Day');
		  data.addColumn('number', 'Traffic');


		  data.addRows([
		  <?php
		  while($row_line = mysqli_fetch_assoc($result_line)) { 
			echo "[new Date(".$row_line['date']."),  ".$row_line['count_traffic']."],";
		  }
		  ?>
		  
			
		  ]);

		  var options = {
			chart: {
			  title: 'LINE Usage',
			  subtitle: 'reply per day'
			},
			series: {
            0: { color: '#0288D1' },
            
          },
			
			
			
			width: 500,
			height: 300
		  };

		  var chart = new google.charts.Line(document.getElementById('linechart_material'));

		  chart.draw(data, google.charts.Line.convertOptions(options));
		}
	}
	
	
	
	</script>
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

	 
	 }, 10000);

}

function show_status() {
	$('#logout_but').css("color", "black");
	$.ajax({
            type: 'POST',
            url: 'get_status.php',
            
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
					
					$('#comeon3').css("color", "black");
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
            url: 'run_cmd.php',
            
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
            url: 'get_detail.php',
            
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
            url: 'get_uptime.php',
            
            //dataType: 'json',
			beforeSend: function() {
				
                
            },
            
            success: function(data) {
                
				$('#r3').text(data);

            },
        });
		
}
</script>
  </head>
  
  <body data-spy="scroll" data-target=".navbar" data-offset="50" onload="show_status();google_chart1();reload_log();uptime();refresh();">
	
<div style="display:none"><img src="Ellipsis.gif"></div>

   
<nav class="navbar nav-link navbar-light fixed-top navbar-expand-lg bg-light">
  <a class="navbar-brand" href="#">MIS Chatbot</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#topuser">Top users <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#topintent">Top intents</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#recentregist">Recently register</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#groupmute">Group mute</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="#traffic">Traffic</a>
      </li>

    </ul>
	


<ul class="nav navbar-nav mx-auto" href="#">	
	<li class="nav-item">  
			<a class="nav-link" href="#traffic">
				<span id="comeon1"></span> Status : <span id="comeon2">...</span> PID : <span id="comeon3">...</span> Uptime : <span id="comeon4">...</span>
			</a>
	</li>
</ul>

    <ul class="nav navbar-nav navbar-right">
				<li class="nav-item" >
					<a class="nav-link" id="logout_but" href="#" onClick="
					
					if (confirm('Are you sure you want to log out ?')) {
						alert('See you again sooooooon');
						logoutme();
						
					} else {
						alert('Welcome back');
					}
					
					"
	
	>Logout</a>
				</li>
	</ul>
  </div>
</nav>


	<div id="topuser"></div>
	<div class="container" style="padding-top:5em;">
			<h4>Top 10 Users</h4>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-3"><h6>UID</h6></div>
				<div class="col-md-3"><h6>LINE Profile Name</h6></div>
				<div class="col-md-2"><h6>Messages</h6></div>
				<div class="col-md-2"></div>
			</div>

			<?php
				while($row_top10 = mysqli_fetch_assoc($result_top10)) { 
					echo "<div class='row'>
							<div class='col-md-2'></div>
							<div class='col-md-3'>"
								.$row_top10['uid'].
							"</div>
							<div class='col-md-3'>"
								.$row_top10['prof_name'].
							"</div>
							<div class='col-md-2'>"
								.$row_top10['time_usage'].
							"</div><div class='col-md-2'></div>
						  </div>"; 
					
				} ?>
			<div id="topintent" style="padding-top:2em;padding-bottom:2em;"></div>
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
  url: 'what.php',
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
					
				} ?>
				<div id="recentregist" style="padding-top:2em;padding-bottom:2em;"></div>
		<h4>Recently Register User | Available Space : <?php echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class]; ?></h4>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-3"><h6>ID</h6></div>
				<div class="col-md-3"><h6>UID</h6></div>
				<div class="col-md-2"><h6>Date Regist</h6></div>
				<div class="col-md-2"></div>
			</div>

			<?php
				while($row_reg = mysqli_fetch_assoc($result_reg)) { 
					echo "<div class='row'>
							<div class='col-md-2'></div>
							<div class='col-md-3'>"
								.$row_reg['id'].
							"</div>
							<div class='col-md-3'>"
								.$row_reg['uid'].
							"</div>
							<div class='col-md-2'>"
								.$row_reg['date_create'].
							"</div><div class='col-md-2'></div>
						  </div>"; 
					
				} ?>
				
				<div id="groupmute" style="padding-top:2em;padding-bottom:2em;"></div>
		<h4>Mute Group</h4>
			<div class="row" id="group_update">
				<div class="col-md-1"></div>
				<div class="col-md-3 text-center"><h6>ID</h6></div>
				<div class="col-md-4"><h6>Group ID</h6></div>
				<div class="col-md-2"><h6>Date Mute</h6></div>
				<div class="col-md-1"></div>
			</div>
			<br><br>
			<div class="alert alert-success n" id="contact-us" style="display:none">
			  <strong>Success!</strong> <span id="remove_what">Delete : </span></a>.
			</div>
			<div class="pre-scrollable2">
			<?php
				while($row2 = mysqli_fetch_assoc($resultmute)) { 
					$what_id = $row2['id'];
					$group_id = $row2['group_id'];
					$group_create = $row2['date_create'];
					
					echo "
						<div id='$what_id'>
							<div class='row'>
							
							<div class='col-md-1'>
								<form  id='popoverData'>
								<input type='hidden' value='$what_id' name='del_id' >
								<input class='btn btn-danger' type='button' name='deletebut' value='Delete'
									onClick=\"$.ajax({
        type: 'POST',
        url: 'del_mute.php',
        data: {del_id: '$what_id'},
        success: function (data) {
            
            $('#contact-us').show();
            $('html, body').animate({ scrollTop: $('#contact-us').offset().top }, 'slow');
			$('#$what_id').remove();
			$('#remove_what').text('$group_id');
			$('#contact-us').fadeOut(3000);
        },
        error: console.log('it did not work'),
    })\"></form>
								
							
							
							
							</div>
							<div class='col-md-3 text-center'>
								$what_id
							</div>
							<div class='col-md-4'>
								$group_id
							</div>
							<div class='col-md-2'>
								$group_create
							</div>
							<div class='col-md-1'></div>
							
						  </div>
						 
						 <hr>
						 </div>"; 
					
				} ?>
		</div>
		<br><br><br><br><br>
		<div id="server"></div>
		
		<div class="row">
			<div class="col-md-2">
				<h4>Server Information</h4>
			</div>
			<div class="col-md-8">
				<h6>Chatbot Status : <span id="s1">Undefined</span></h6>
				<h6>Chatbot  PID : <span id="s2">Undefined</span></h6>
				<h6>Chatbot  Uptime : <span id="s3">Undefined</span></h6>	
				<br><br>
				<h6>Server Memory Usage : <span id="r1"><?php echo get_server_memory_usage();?></span></h6>	
				<h6>Server CPU Usage : <span id="r2"><?php echo get_server_cpu_usage();?></span></h6>	
				<h6>Server Uptime : <span id="r3">Undefined</span></h6>	
				
				<br><br>
				<h6>Server Log : </h6>
				<br>
				<br>
				<div id="log" class="pre-scrollable2">
					
				</div>
				
				
			</div>
			<div class="col-md-2"><h6>Server Control</h6>
				<button class="btn btn-success btn-block" onClick="start_server();">Start</button><button class="btn btn-danger btn-block" onClick="start_server();">Stop</button>
			</div>
		</div>
		<br><br><br><br><br>
		<div id="traffic" ></div>
		
		<div class="row">
			<div class="col-md-2">
				<h4>Traffic</h4>
			</div>
			<div class="col-md-8">
			
				
					<div id="linechart_material" style="width:100%"></div>
				
			</div>
			<div class="col-md-2">
				
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