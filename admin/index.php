<?php


@include "db.php";





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
  
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <title>Hello, world!</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	window.onload = function () {

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
			width: 900,
			height: 500
		  };

		  var chart = new google.charts.Line(document.getElementById('linechart_material'));

		  chart.draw(data, google.charts.Line.convertOptions(options));
		}
	}
	
	
	
	</script>
	<style>
	form {
		    margin-bottom: 0em !important; 
	}
	</style>
  </head>
  
  <body>
	
	
	<button onClick="$.ajax({
  type: 'POST',
  url: 'what.php',
  dataType: 'json',
  success: function(data){
    console.log(data); // overflow
    
  }
});"
>whatthefuck</button>
   



	<div class="container">
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
					echo "<div class='row'>
							<div class='col-md-2'></div>
							<div class='col-md-3'>"
								.$row_intent['intent'].
							"</div>
							<div class='col-md-3'>"
								.$row_intent['time'].
							"</div>
							<div class='col-md-2'>"
								.$row_intent['last_see'].
							"</div><div class='col-md-2'></div>
						  </div>"; 
					
				} ?>
				
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
			<?php
				while($row2 = mysqli_fetch_assoc($resultmute)) { 
					$what_id = $row2['id'];
					$group_id = $row2['group_id'];
					$group_create = $row2['date_create'];
					
					echo "
						<div id='$what_id'>
							<div class='row'>
							
							<div class='col-md-1'>
								<form  id='$what_id'>
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


		<div class="row">
			<div class="col-md-2">
				
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