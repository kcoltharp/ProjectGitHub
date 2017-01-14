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
						The South Carolina Concealed Weapons Permit Class is held at the Maryville Social Hall, 2009 South Fraser Street, Georgetown, SC 29440.
					</div>
				</div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3333.0623445544916!2d-79.298082!3d33.343321!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd5ca333b4c9b20e6!2sMaryville+Social+Hall!5e0!3m2!1sen!2sus!4v1460747638641" allowfullscreen></iframe>
				<div class="relative">
					<footer class="absolute">
						<p>Website Designed by: Kenny Coltharp &copy 2015</p>
						<p>Contact information: <a href="mailto:cwp@sc-cwp.kennys-spot.org">cwp@sc-cwp.kennys-spot.org</a>.</p>
					</footer>
				</div>
			</div>
		</div>
	</body>
</html>