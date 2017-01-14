<?php
require_once 'app/init.php';

if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(login($username, $password)){
		echo '<META http-equiv="refresh" content="1;URL=http://localhost/Grocery_ToDo_List/">';
	}
	else{
		echo '<center><h2>There was an error logging you in!</h2></center>';
		echo '<a href="http://localhost/Grocery_ToDo_List/">Please try again!</a>';
		
	}
}

function login($user, $pass) {
	 session_unset();
	$loggedIn = false;
	$username = sanitize($user);
	$password = md5($pass);
	$seconds = 5;
	
	$dsn = 'mysql:dbname=grocery; host=localhost';
	$uname = 'kenny';
	$pword = 'kc226975';
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

	try{
		$db = new PDO($dsn,$uname, $pword, $options);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	catch (Exception $ex){
		die('You are not signed in!');
	}
	
	//$sql = "SELECT * FROM `users` WHERE `username` = \'kenny\' AND `password` = md5(\'kc226975\')";
	$sql = "SELECT COUNT(*) FROM `users` WHERE `username` = $username AND `password` = $password";
	if($result = $db->query($sql)){
		if($result->fetchColumn() > 0){
			$sql = "SELECT * FROM `users` WHERE `username` = $username AND `password` = $password";
			foreach($db->query($sql) as $row){
				$loggedIn = true;
				var_dump($row);
				echo $row[0] . "<br />";
				echo $row[1] . "<br />";
				echo $row[2] . "<br />";
				echo $row[3] . "<br />";
				echo $row[4] . "<br />";
				echo $row[5] . "<br />";
			}
		}else{
			echo 'No Columns returned<br />';
		}
	}
//	if($count){
//		print_r($db);
//		var_dump($db);
//		$loggedIn = true;
//		$_SESSION['date'] = date("F j, Y, g:i a");
//		$_SESSION['username'] = $username;
//	}
//	echo "<br /><br />";
//	print_r($db);
//	echo "<br /><br />";
//		
//		echo "<br />";
//	print $loggedIn . "<br /><br />";
//	print $_SESSION['username'] . "<br />";
//	print $_SESSION['date'] . "\n";

	return $loggedIn;
}

function logged_in() {
	return (isset($_SESSION['username'])) ? true : false;
}

function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}
?>