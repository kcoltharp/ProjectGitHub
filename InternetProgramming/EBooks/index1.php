<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Kenny's Spot</title>
		<link rel="stylesheet" type="text/css" href="css/screen.css" />
		<script src="http://yui.yahooapis.com/3.6.0/build/yui/yui-min.js"></script>
		<script>
			// Pull in the scrollview widget, and the paginator plugin
			YUI().use('scrollview', 'scrollview-paginator', function(Y) 
			{
				...
			});
		</script>
	</head>
	<body>
		<div id="container">
			<ul id="nav">
				<li><div class="icon">R</div><a href="../main.php../main.php" title="Click here for..."><h4>Favourite</h4> <span>View your favourites</span></a></li>
				<li><div class="icon">S</div><a href="main.php" title="Click here for..."><h4>Sorted by Author's Last Name</h4> <span>Edit your settings</span></a></li>
				<li><div class="icon">U</div><a href="search/searchForm.inc.php" title="Click here for..."><h4>Search Books</h4> <span>Change your details</span></a></li>
				<li><div class="icon">d</div><a href="#" title="Click here for..."><h4>Feedback</h4> <span>View your comments</span></a></li>
				<li><div class="icon">W</div><a href="#" title="Click here for..."><h4>Alerts</h4> <span>Personalise Your alerts</span></a></li>			
			</ul>
			<div id="panel">
				<table class="pagination" cellpadding="5" border="1">
					<?php
					$pages_dir = '/php';

					if ( ! empty ( $_GET[ 'p' ] ) )
					{
						$pages = scandir ( $pages_dir, 0 );
						unset ( $pages[ 0 ], $pages[ 1 ] );

						$p = $_GET[ 'p' ];

						if ( in_array ( $p . '.inc.php', $pages ) )
						{
							include ($pages_dir . '/' . $p . '.inc.php');
						}
						else
						{
							echo 'Sorry, page not found!';
						}
					}
					else
					{
						include('/php/home.inc.php');
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>
