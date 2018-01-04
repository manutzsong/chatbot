<!doctype html>
<html>

<head>
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASi5QIUn-hpyZbPyUJXBcVTkaPWP57ZDY"></script>
	<script src="gmaps.js"></script>
	
	
	 <!-- cdnjs -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.6/jquery.lazy.plugins.min.js"></script>
                
	
	
	<style type="text/css">
		#map {
			width: 550px;
			height: 300px;
		}
	</style>
	

	<link rel="stylesheet" href="style.css">
	<link href="lightbox.css" rel="stylesheet">

	<script>
		window.onscroll = function () {
			myFunction()
		};

		function myFunction() {
			if ( document.body.scrollTop > 25 || document.documentElement.scrollTop > 25 ) {
				document.getElementById( 'navbar' ).style.backgroundColor = "black";
			} else {
				document.getElementById( 'navbar' ).style.backgroundColor = "rgba(0,0,0,0.1)";
			}
		}
	</script>
	<script>
	$(function($) {
    $("img.lazy").Lazy();
});</script>

<script>
	function blink_text() {
    $(".blink").fadeTo(100, 0.1).fadeTo(200, 1.0);
	
}
setInterval(blink_text, 1000);
	</script>

	<meta charset="utf-8">
	<title>Song Purin</title>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">




	<div class="container-fluid" id="home">


		<div class="head_bg container-middle-me">
			<div>
				<h1>P U  R I N<span class="blink">_</span> </h1>
				<div class="row">
					<div class="col">
						<h2>K O E T T I P </h2>
					</div>
					<div class="col yellow_this">
						<p>P E R S O N A L <br> P O R T F O L I O <br> N O T H I N G <br> S P E C I A L <br> B Y T H E W A Y <br> W E L C O M E</p>
					</div>
				</div>
			</div>


		</div>

	</div>

	<nav class="navbar navbar-toggleable-md navbar-light sticky bg-blue navbar-inverse fading" id="navbar">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
	


		<a class="navbar-brand" href="#home">Portfolio</a>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="#about">Me</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#works">Projects</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#gallery">Explore the World</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
					<a class="nav-link" href="#contact_me">Contact me</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container" id="about" style="margin-top:5%;">
		<div class="row">
			<div class="col-6">
				<h1>About{Purin Koettip}</h1>
			</div>
			<div class="col-6"></div>
		</div>
	</div>
	<div class="container box">

		<div class="row">
			<div class="col-md-6">




				<h2>I am a computer <span style="color:#EA4C89">lover.</span> <br><span style="color:#7FBB42">Website</span> is my passion<br>and anything that relate to computer <span style="color:#32A0DA">programing.</span> <br>I am still studying in Assumption University. <br>Hoping that one day I will become full time developer in big company.</h2>
			</div>
			<div class="col-md-6 align-self-center">

				<img src="./pics/me3.jpg">
			</div>


		</div>
		<div class="row">
			<div class="col">
				<h2>techical skills</h2>

				<div class="skillbar" data-percent="35%">
					<div class="skillbar-title">HTML</div>
					<div class="skill-bar-percent">35%</div>
					<div class="skillbar-bar skillbar-blue" style="width: 35%;"></div>
				</div>
				<div class="skillbar" data-percent="20%">
					<div class="skillbar-title">Python</div>
					<div class="skill-bar-percent">20%</div>
					<div class="skillbar-bar skillbar-green" style="width: 20%;"></div>
				</div>
				<div class="skillbar" data-percent="30%">
					<div class="skillbar-title">Javascript</div>
					<div class="skill-bar-percent">30%</div>
					<div class="skillbar-bar skillbar-red" style="width: 30%;"></div>
				</div>
				<div class="skillbar" data-percent="40%">
					<div class="skillbar-title">PHP</div>
					<div class="skill-bar-percent">20%</div>
					<div class="skillbar-bar skillbar-cyan" style="width: 20%;"></div>
				</div>
				<div class="skillbar" data-percent="30%">
					<div class="skillbar-title">C#</div>
					<div class="skill-bar-percent">40%</div>
					<div class="skillbar-bar skillbar-orange" style="width: 40%;"></div>
				</div>
				<div class="skillbar" data-percent="50%">
					<div class="skillbar-title">Ubuntu (Unix system)</div>
					<div class="skill-bar-percent">40%</div>
					<div class="skillbar-bar skillbar-purple" style="width: 40%;"></div>
				</div>

			</div>
			<div class="col name_info align-self-center">
				<h5><span style="color:#EA4C89">full name : </span>purin koettip<br>
				  <span style="color:#7FBB42">dob : </span>18 november 1995<br>
				  <span style="color:#32A0DA">address : </span>39 m.1 Thatako, Nakhon Sawan, Thailand 60160<br>
				  <span style="color:red">email : </span>manutzsong@gmail.com<br>
				 <span style="color:#32A0DA"> phone : </span>(+66)83-488-6522<br>
				  </h5>
			</div>
		</div>







		<div class="row">
			<div class="col align-self-center">
				<h4><span style="color:#32A0DA">Bachelor of Business Administration |<br>Business Information Technology </span><br>
Assumption University of Thailand / 4th year <br><br><br>


<span style="color:#7FBB42">Science and Mathematic</span>
Lasalle Chotiravi NakhonSawan</h4>




			</div>
			<div class="col">
				<h1>personal skills</h1>
				<div class="skillbar" data-percent="90%">
					<div class="skillbar-title">Team-play</div>
					<div class="skillbar-bar skillbar-green" style="width: 90%;"></div>
				</div>
				<div class="skillbar" data-percent="80%">
					<div class="skillbar-title">Self-motivated</div>
					<div class="skillbar-bar skillbar-blue" style="width: 80%;"></div>
				</div>
				<div class="skillbar" data-percent="70%">
					<div class="skillbar-title">Adaptability</div>
					<div class="skillbar-bar skillbar-purple" style="width: 70%;"></div>
				</div>
				<div class="skillbar" data-percent="80%">
					<div class="skillbar-title">Dependability</div>
					<div class="skillbar-bar skillbar-green2" style="width: 80%;"></div>
				</div>
			</div>
		</div>










	</div>
	<div class="container" id="works">
		<div class="row">
			<div class="col-6"></div>
			<div class="col-6 text-right">
				<h1>Projects</h1>
				<h5>{C#,Python,PHP,HTML}</h5>
			</div>
		</div>
	</div>

	<div class="container box">

		<br><br>
		<div class="row">
			<div class="col-3">
				<a href="portf/p1.PNG" data-lightbox="c"><img src="portf/p1.PNG"></a>
			</div>
			<div class="col-3">
				<a href="portf/p2.PNG" data-lightbox="c"><img src="portf/p2.PNG"></a>
			</div>
			<div class="col-3">
				<a href="portf/p3.PNG" data-lightbox="c"><img src="portf/p3.PNG"></a>
			</div>
			<div class="col-3 align-self-center">
				<h6>Rental Management Software</h6>
				<span>Add/Edit/Update/Delete Product</span><br>
				<span>Add/Edit/Update/Customer</span><br>
				<span>Add/Edit/Update/Delete Order</span><br>
				<span>Edit DB Connection, Login System, QR Scan</span>
			</div>
		</div>
		<br>
		<hr><br>
		<div class="row">
			<div class="col-3 align-self-center">
				<h5>Food Directory Website</h5>
				<span>It's a website where you can find what to eat, drink or even hangout with your friends.</span>
			</div>
			<div class="col-3">
				<a href="portf/f2.PNG" data-lightbox="food"><img src="portf/f2.PNG"></a>
			</div>
			<div class="col-3">
				<a href="portf/f3.PNG" data-lightbox="food"><img src="portf/f3.PNG"></a>
			</div>
			<div class="col-3">
				<a href="portf/f1.PNG" data-lightbox="food"><img src="portf/f1.PNG"></a>

			</div>
		</div>
		<br>
		<hr><br>

		<div class="row">
			<div class="col-3">
				<a href="portf/b1.PNG" data-lightbox="bot"><img src="portf/b1.PNG"></a>
			</div>
			<div class="col-3">
				<a href="portf/b2.PNG" data-lightbox="bot"><img src="portf/b2.PNG"></a>
			</div>
			<div class="col-3">
				<a href="portf/b3.PNG" data-lightbox="bot"><img src="portf/b3.PNG"></a>
			</div>
			<div class="col-3 align-self-center">
				<h6>LINE Chatbot</h6>
				<span>Answer about Assumption University</span><br>
				<span>Answer Course Detail</span><br>
				<span>Flask + Gunicon</span><br>
			</div>
		</div>

		<br><br>

	</div>

	<br><br>

	<div class="container-fluid" id="gallery">
		<div class="masonry">

			<?php  
                  $files = glob('pics/*.{jpg,png,gif}', GLOB_BRACE);
                  foreach($files as $file) {

                  
                  echo('<div class="item"><a href="'.$file.'" data-lightbox="roadtrip"><img class="lazy" data-src="thumbnails_'.$file.'" alt="random image"></a></div>'); }
	
                  ?>
		</div>


	</div>

	<br><br><br>

	<div class="container" id="contact_me">
		<div class="row">
			<div class="col-6"></div>
			<div class="col-6 text-right">
				<h1>Contact</h1>

			</div>
		</div>
	</div>



	<div class="container box">
		<br>
		<div class="row">
			<div class="col">

				<div id="map"></div>

				
  <script type="text/javascript">
    var map;
    $(document).ready(function(){
      map = new GMaps({
        el: '#map',
        lat: 15.639800,
		lng: 100.481942
      });
      map.addMarker({
        lat: 15.639800,
		lng: 100.481942,
        title: 'Lima',
        details: {
          database_id: 42,
          author: 'HPNeo'
        },
        click: function(e){
          if(console.log)
            console.log(e);
          alert('Me, right there!');
        }
        
      });
    });
  </script>

				<br>

				<h5>A D D R E S S</h5>
				<p>
					39 8 Thanwa Rd., Thatako sub-district, Thatako district Nakhon Sawan 60160 Thailand
				</p>
				<div class="row">
					<div class="col-6">
						<h5>T E L E P H O N E</h5>
						<p>(+66) 83-488-6522</p>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<h3>L I N E</h3>
						<p>songpurin</p>
					</div>
					<div class="col-6">
						<h5>E M A I L</h5>
						<p>manutzsong@gmail.com</p>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<h5>I n s t a g r a m</h5>
						<p><a href="https://www.instagram.com/songpurin/?hl=en">songpurin</a><br>
						</p>
					</div>
					<div class="col-6">
						<h5>F A C E B O O K</h5>
						<p><a href="https://www.facebook.com/manutzsong">Song Purin</a>
						</p>
					</div>
				</div>





			</div>
			<div class="col align-self-center">

				<form class="form">
					<input class="form-control" placeholder="Name">
					<br>
					<input class="form-control" placeholder="E-mail">
					<br>
					<input class="form-control" placeholder="Phone">
					<br>
					<label>Subject</label>
					<input class="form-control" placeholder="Message subject">
					<br>
					<label>Message</label>
					<textarea class="form-control" placeholder="Message"></textarea>
					<br>
					<button type="button" class="btn btn-primary btn-md">Send Message</button>




				</form>
			</div>

		</div>
		<br><br>
	</div>





	<br><br>




</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="lightbox.js"></script>
<script>
	// Select all links with hashes
	$( 'a[href*="#"]' )
		// Remove links that don't actually link to anything
		.not( '[href="#"]' )
		.not( '[href="#0"]' )
		.click( function ( event ) {
			// On-page links
			if (
				location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) &&
				location.hostname == this.hostname
			) {
				// Figure out element to scroll to
				var target = $( this.hash );
				target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
				// Does a scroll target exist?
				if ( target.length ) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					$( 'html, body' ).animate( {
						scrollTop: target.offset().top
					}, 1000, function () {
						// Callback after animation
						// Must change focus!
						var $target = $( target );
						$target.focus();
						if ( $target.is( ":focus" ) ) { // Checking if the target was focused
							return false;
						} else {
							$target.attr( 'tabindex', '-1' ); // Adding tabindex for elements not focusable
							$target.focus(); // Set focus again
						};
					} );
				}
			}
		} );
</script>

</html>