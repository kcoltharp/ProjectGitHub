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

					We are sorry that you have decided not to use us as your instructors for the concealed weapons permit. Please tell us what we could do to get you in our class. Below is an area to send us your comments, which are completely anonymous.<br /><br />

					<form id="comments" action="php/functions/postComments.php" method="post">

						<label for="subject">Subject:</label>
						<input type="text" id="subject" name="subject" placeholder="Comments Subject"><br /><br />
						<label for="comment">Comments:</label>
						<textarea rows="4" cols="50" id="comment" name="comment" placeholder="None"></textarea>
						<input type="submit" value="Submit Comments">
					</form>
					<div class="relative">
						<footer class="absolute">
							<p>Website Designed by: Kenny Coltharp &copy 2015</p>
							<p>Contact information: <a href="mailto:cwp@sc-cwp.kennys-spot.org">cwp@sc-cwp.kennys-spot.org</a>.
						</footer>
					</div>
				</div>
			</div>
	</body>
</html>