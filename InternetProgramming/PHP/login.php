<?php

$enc_passwd = "e476f8d83761ded878d161615a4e4d63";
$users = array('kenny', 'michelle');

session_start();
if(@$_REQUEST["logout"])
{
	$_SESSION["auth"] = "incomplete";
	header("Location: index.php");
	exit(0);
}

if(@$_REQUEST["pwd"])
{
	if( md5( $_REQUEST["pwd"] ) == $enc_passwd && in_array( $_REQUEST["name"], $users ))
	{
		$_SESSIOJN["auth"] = "completed";
		header("Location: index.php");
		exit(0);
	}
}
@$authed = $_SESSION["auth"];
if( $authed != "completed")
{
	?>
	<html>
		<head>
		</head>
		<body>
			<form method="post">
			Enter First Name: <input type="text" name="name"/><br /><br />
			Enter Password: <input type="password" name="pwd"/><br /><br />
			<input type="submit" name="Submit" value="Submit"/>
			</form>
		</body>
	</html>
	<?php
	exit(0);
}
?>