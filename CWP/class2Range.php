<?php
require('init.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Carolina Firearms & Training</title>
		<!-- get jQuery 1.11.1 from CDN -->
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<!-- get jQuery validation plugin from CDN -->
		<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
		<!-- get javascript for this webpage -->
		<script src="js/main.js"></script>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Favicon to use -->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
		<!-- Google Fonts -->
		<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Cinzel:700|UnifrakturMaguntia|Rye|Faster+One' rel='stylesheet' type='text/css'>
		<!-- link stylesheet for this webpage -->
		<!--
		<link rel="stylesheet" href="styles/main.css">
		-->
		<link rel="stylesheet" href="styles/mobile.css">
	</head>
	<body>
		<div class='wrapper'>
			<div class='sidebar'>
				<?php
				require('navigation.php');
				?>
				<header>
					Carolina Firearms and Training
				</header>
				<br /><br />
				<div id="container">
					<div class="mapDesc">
						This map shows the quickest route from the classroom to the shooting range. The range is located on B.A. Grantham, the map shows the range on Browns Ferry Road. This is incorrect, the marker for the range on the map is in the correct place. You will see a blue street sign with B.A. Grantham on it, turn right at the street sign. The range is located at the end of the gravel road.
					</div>
				</div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d179149.90562924065!2d-79.38390983171344!3d33.45323774420828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e0!4m5!1s0x89002b5a16912d87%3A0xd5ca333b4c9b20e6!2sMaryville+Social+Hall%2C+2009+S+Fraser+St%2C+Georgetown%2C+SC+29440!3m2!1d33.34545!2d-79.296848!4m3!3m2!1d33.444339299999996!2d-79.3002988!5e0!3m2!1sen!2sus!4v1460746774865" allowfullscreen></iframe>
				<div class="relative">
					<footer class="absolute">
						<p>Website Designed by: Kenny Coltharp &copy 2015</p>
						<p>Contact information: <a href="mailto:cwp@sc-cwp.kennys-spot.org">cwp@sc-cwp.kennys-spot.org</a>.</p>
					</footer>
				</div>
			</div>
		</div>
	</div>
</body>
</html>