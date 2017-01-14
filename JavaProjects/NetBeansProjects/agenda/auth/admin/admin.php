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
 * Copyright 2006-2007, Thomas Abeel
 * 
 * Project: http://sourceforge.net/projects/php-agenda/
 * 
 */
?>
<?php

/**
 * Admin.php
 *
 * This is the Admin Center page. Only administrators
 * are allowed to view this page. This page displays the
 * database table of users and banned users. Admins can
 * choose to delete specific users, delete inactive users,
 * ban users, update user levels, etc.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */
include ("../include/session.inc.php");
if(!$session->isAdmin()){
	header("Location: ../index.php");
	die();
}
/**
 * displayUsers - Displays the users database table in
 * a nicely formatted html table.
 */
function displayUsers() {
	global $database;
	$q = "SELECT username,userlevel,email,timestamp " .
	"FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
	$result = $database->query($q);
	/* Error occurred, return given name by default */
	$num_rows = mysql_numrows($result);
	if (!$result || ($num_rows < 0)) {
		echo "Error displaying info";
		return;
	}
	if ($num_rows == 0) {
		echo "Database table empty";
		return;
	}
	/* Display table contents */
	echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
	echo "<tr><td><b>Username</b></td><td><b>Level</b></td><td><b>Email</b></td><td><b>Last Active</b></td></tr>\n";
	for ($i = 0; $i < $num_rows; $i++) {
		$uname = mysql_result($result, $i, "username");
		$ulevel = mysql_result($result, $i, "userlevel");
		$email = mysql_result($result, $i, "email");
		$time = mysql_result($result, $i, "timestamp");

		echo "<tr><td>$uname</td><td>$ulevel</td><td>$email</td><td>$time</td></tr>\n";
	}
	echo "</table><br>\n";
}

/**
 * displayBannedUsers - Displays the banned users
 * database table in a nicely formatted html table.
 */
function displayBannedUsers() {
	global $database;
	$q = "SELECT username,timestamp " .
	"FROM " . TBL_BANNED_USERS . " ORDER BY username";
	$result = $database->query($q);
	/* Error occurred, return given name by default */
	$num_rows = mysql_numrows($result);
	if (!$result || ($num_rows < 0)) {
		echo "Error displaying info";
		return;
	}
	if ($num_rows == 0) {
		echo "Database table empty";
		return;
	}
	/* Display table contents */
	echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
	echo "<tr><td><b>Username</b></td><td><b>Time Banned</b></td></tr>\n";
	for ($i = 0; $i < $num_rows; $i++) {
		$uname = mysql_result($result, $i, "username");
		$time = mysql_result($result, $i, "timestamp");

		echo "<tr><td>$uname</td><td>$time</td></tr>\n";
	}
	echo "</table><br>\n";
}

/**
 * User not an administrator, redirect to main page
 * automatically.
 */
if (!$session->isAdmin()) {
	header("Location: ../../index.php");
} else {
	/**
	 * Administrator is viewing page, so display all
	 * forms.
	 *
	 */
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title>My Agenda</title>
</head>
<body>
<h1>Admin Center</h1>
<font size="5" color="#ff0000">
<b>::::::::::::::::::::::::::::::::::::::::::::</b></font>
<font size="4">Logged in as <b><?php echo $session->username; ?></b></font><br><br>
Back to [<a href="../../index.php">Main Page</a>]<br><br>
<?php

	if ($form->num_errors > 0) {
		echo "<font size=\"4\" color=\"#ff0000\">" .
		"!*** Error with request, please fix</font><br><br>";
	}
?>

<h3>Register new user</h3>
<a href="../register.php">Register new user</a>

<table align="left" border="0" cellspacing="5" cellpadding="5">
<tr><td>
<?php

	/**
	 * Display Users Table
	 */
?>
<h3>Users Table Contents:</h3>
<?php

	displayUsers();
?>
</td></tr>
<tr>
<td>
<br>
<?php

	/**
	 * Update User Level
	 */
?>
<h3>Update User Level</h3>
<?php echo $form->error("upduser"); ?>
<table>
<form action="adminprocess.php" method="post">
<tr><td>
Username:<br>
<input type="text" name="upduser" maxlength="30" value="<?php echo $form->value("upduser"); ?>">
</td>
<td>
Level:<br>
<select name="updlevel">
<option value="1">1
<option value="9">9
</select>
</td>
<td>
<br>
<input type="hidden" name="subupdlevel" value="1">
<input type="submit" value="Update Level">
</td></tr>
</form>
</table>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php

	/**
	 * Delete User
	 */
?>
<h3>Delete User</h3>
<?php echo $form->error("deluser"); ?>
<form action="adminprocess.php" method="post">
Username:<br>
<input type="text" name="deluser" maxlength="30" value="<?php echo $form->value("deluser"); ?>">
<input type="hidden" name="subdeluser" value="1">
<input type="submit" value="Delete User">
</form>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php

	/**
	 * Delete Inactive Users
	 */
?>
<h3>Delete Inactive Users</h3>
This will delete all users (not administrators), who have not logged in to the site<br>
within a certain time period. You specify the days spent inactive.<br><br>
<table>
<form action="adminprocess.php" method="post">
<tr><td>
Days:<br>
<select name="inactdays">
<option value="3">3
<option value="7">7
<option value="14">14
<option value="30">30
<option value="100">100
<option value="365">365
</select>
</td>
<td>
<br>
<input type="hidden" name="subdelinact" value="1">
<input type="submit" value="Delete All Inactive">
</td>
</form>
</table>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php

	/**
	 * Ban User
	 */
?>
<h3>Ban User</h3>
<?php echo $form->error("banuser"); ?>
<form action="adminprocess.php" method="post">
Username:<br>
<input type="text" name="banuser" maxlength="30" value="<?php echo $form->value("banuser"); ?>">
<input type="hidden" name="subbanuser" value="1">
<input type="submit" value="Ban User">
</form>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr><td>
<?php

	/**
	 * Display Banned Users Table
	 */
?>
<h3>Banned Users Table Contents:</h3>
<?php

	displayBannedUsers();
?>
</td></tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td>
<?php

	/**
	 * Delete Banned User
	 */
?>
<h3>Delete Banned User</h3>
<?php echo $form->error("delbanuser"); ?>
<form action="adminprocess.php" method="post">
Username:<br>
<input type="text" name="delbanuser" maxlength="30" value="<?php echo $form->value("delbanuser"); ?>">
<input type="hidden" name="subdelbanned" value="1">
<input type="submit" value="Delete Banned User">
</form>
</td>
</tr>
</table>
</body>
</html>
<?php

}
?>

