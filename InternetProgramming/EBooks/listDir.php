<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Kenny's Spot</title>
		<link rel="stylesheet" type="text/css" href="css/screen.css" />
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
<?php

function dirRead( $dirToRead )
{
	if ( $dirToRead != "." && $dirToRead != ".." )
	{
		if ( is_dir( $dirToRead ) && is_readable( $dirToRead ) )
		{
			if ( $handle = scandir ( $dirToRead ) )
			{
				foreach( $handle as &$value)
				{
					if ( ( is_dir( $value ) ) && $value != "." && $value != ".." )
					{
						//echo $value . "<br />";
						echo "<a href='http://localhost/EBooks/$value'>$value</a><br />";
						dirRead( $value );
					}
				}				
			}
		}
		else
		{
			echo $dirToRead . ' is either not a directory or not readable!<br />';
			echo $php_errormsg;
		}
	}
}//end function dirRead()

function createFile( $dir )
{
	$file = "index.php";
	
	if ( file_exists( $dir . "/" . $file ) )
	{
		echo  $dir . "/" . $file . ' already exists!';
	}
	else
	{
		if( fopen( $dir . "/" . $file, 'w+' ) )
		{
			echo $dir . "/" . $file . ' was created!<br />';
			writeToFile( $dir . "/" . $file );
		}
		else
		{
			echo "ERROR: " . $php_errormsg . "<br />";
		}
	}
	
}

function writeToFile( $dir )
{
	if ( $fileToRead = file_get_contents( "C:/server/www/PHP/EBooks/books/index.php" ) )
	{
		$fileName = $dir . "\\" . "index.php";
		if ( file_put_contents( $fileName, $fileToRead ) )
		{
			echo 'Successfully created and written to ' . $fileName;
		}
		else
		{
			echo "ERROR: " . $php_errormsg . "<br />";
		}
	}
	else
	{
		echo "ERROR: " . $php_errormsg . "<br />";
	}
}

dirRead(getcwd());

?>
			</div>
		</div>
	</body>
</html>
