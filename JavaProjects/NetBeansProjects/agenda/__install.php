<?php

/**
 * This file is part of php-agenda.
 * 
 * php-agenda is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * php-agenda is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with php-agenda; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * Copyright 2006, Thomas Abeel
 * 
 * Project: http://sourceforge.net/projects/php-agenda/
 * 
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title>Install the Simple PHP Agenda</title>
  <style type="text/css">
body {
  font-family: georgia;
  margin: 2em;    
}
div label {
  display: block;
  font-size: 0.8em;
}
div {
  margin-bottom: 0.5em;    
}
input.invalid {
  background-color: pink;
}
strong.error {
  color: red;
}
  </style>
</head>
<body>
<h1>Install the Simple PHP Agenda</h1>
<?php
include ("adodb/adodb.inc.php");
include ('config.inc.php');
if (isset ($_POST["user"])) {
	echo "If you don't see any errors below the agenda was installed succesfully.";
	echo "<h2>Delete the install.php file as it can override your admin settings!!!</h2>";
	//create database
	$db = ADONewConnection('mysql'); # eg 'mysql' or 'postgres'
	$db->debug = true;
	$username = $_POST["user"];
	$pass = md5($_POST["pass1"]);

	/**
	 * Creating database
	 */
	$db->Connect($dbhost, $dbuser, $dbpass);
	$db->SelectDB($dbname);

	/**
	 * Creating user tables
	 */
	$db->Execute("CREATE TABLE `".$dbprefix."users` (
			  `username` varchar(30) NOT NULL,
			  `password` varchar(32) default NULL,
			  `userid` varchar(32) default NULL,
			  `userlevel` tinyint(1) unsigned NOT NULL,
			  `email` varchar(50) default NULL,
			  `timestamp` int(11) unsigned NOT NULL,
			  `id` int(11) NOT NULL auto_increment,
			  PRIMARY KEY  (`id`)
			)");

	$db->Execute("CREATE TABLE ".$dbprefix."active_users (
				 username varchar(30) primary key,
				 timestamp int(11) unsigned not null
				);");

	$db->Execute("CREATE TABLE ".$dbprefix."active_guests (
				 ip varchar(15) primary key,
				 timestamp int(11) unsigned not null
				);");

	$db->Execute("CREATE TABLE ".$dbprefix."banned_users (
				 username varchar(30) primary key,
				 timestamp int(11) unsigned not null
				);");

	//$db->Execute("CREATE TABLE `users` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,`display_name` VARCHAR( 200 ) NOT NULL ,`md5pass` CHAR( 32 ) NOT NULL);");
	//$sql = "INSERT INTO `users` ( `display_name` , `md5pass` )VALUES ('$user', '$pass');";
	$email = mysql_real_escape_string($_POST["email"]);
	$ulevel = 9;
	$username = mysql_real_escape_string($_POST["user"]);
	$password = md5($_POST["pass1"]);
	$time = time();
	$sql = "INSERT INTO `".$dbprefix."users` (username,password,userid,userlevel,email,timestamp) VALUES ('$username', '$password', '0', $ulevel, '$email', $time)";
	$db->Execute($sql);
	$sql = "ALTER TABLE `".$dbprefix."users` ADD `settings` TEXT NOT NULL";
	$db->Execute($sql);

	/**
	 * Creating events table
	 */
	$sql = "CREATE TABLE `".$dbprefix."events` (
								  `id` int(11) NOT NULL auto_increment,
								  `user_id` int(11) NOT NULL default '0',
								  `date` int(11) NOT NULL default '0',
								  `title` text  NOT NULL,
								  `description` text NOT NULL,
								  `added` int(11) NOT NULL default '0',
								  `status` tinyint(4) NOT NULL default '0',
								  `deadline` tinyint(4) NOT NULL default '0',
								  `dayevent` tinyint(4) NOT NULL default '0',
								  PRIMARY KEY  (`id`),
								  KEY `user_id` (`user_id`)
								)";
	$db->Execute($sql);

	$sql = "CREATE TABLE `".$dbprefix."reminders` (
				`userid` INT NOT NULL ,
				`eventid` INT NOT NULL ,
				`time` INT NOT NULL ,
				`sent` INT NOT NULL DEFAULT '0',
				PRIMARY KEY ( `userid` , `eventid`,`time` )
			)";
	$db->Execute($sql);

	/**
	 * Creating TODO table
	 */
	$sql = "CREATE TABLE `".$dbprefix."todo` (
							  `id` int(11) NOT NULL auto_increment,
							  `user_id` int(11) NOT NULL default '0',
							  `priority` tinyint(4) NOT NULL default '0',
							  `text` text NOT NULL,
							  `added` int(11) NOT NULL default '0',
							  `status` tinyint(4) NOT NULL default '0',
							  `closed` int(11) NOT NULL default '0',
							  PRIMARY KEY  (`id`),
							  KEY `user_id` (`user_id`)
							)";
	$db->Execute($sql);
	
	$sql = "CREATE TABLE `".$dbprefix."event_target` (
`user_id` INT NOT NULL ,
`event_id` INT NOT NULL ,
PRIMARY KEY ( `user_id` , `event_id` ))";
	$db->Execute($sql);
	
	$sql = "CREATE TABLE `".$dbprefix."projects` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`parent` INT NOT NULL DEFAULT '-1',
`user_id` INT NOT NULL ,
`name` TEXT NOT NULL
)";
	$db->Execute($sql);
	
		$sql = "CREATE TABLE `".$dbprefix."taskproject` (
`project_id` INT NOT NULL ,
`task_id` INT NOT NULL ,
PRIMARY KEY ( `project_id` , `task_id` )
) ";
	
	$db->Execute($sql);
	$db->Close();

}else{
?>
<p><em>Please make sure that you have entered the database connection details in config.inc.php!!!</a></p>
<form action="install.php" method="post">
<label for="user">Admin agenda user:</label>
<input type="text" name="user"/><br/>
<label for="pass1">Admin agenda pass:</label>
<input type="password" name="pass1"/><br/>
<label for="pass2">Confirm pass:</label>
<input type="password" name="pass2"/><br/>
<label for="email">Admin email:</label>
<input type="text" name="email"/><br/>
<div><input type="submit" value="Create Agenda" /></div>
</form>


<?php
}
?>

</body>
</html>