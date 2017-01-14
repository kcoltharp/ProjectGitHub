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

/**
 * UserEdit.php
 *
 * This page is for users to edit their account information
 * such as their password, email address, etc. Their
 * usernames can not be edited. When changing their
 * password, they must first confirm their current password.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */
include ("include/session.inc.php");
include ('../lang/lang.inc.php');
include ('../includes/timezone.inc.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <?php

if (isset ($_SESSION['useredit'])) {
	echo '<meta http-equiv="refresh" content="3;url=useredit.php">';
}
?>
  <title>The Simple PHP Agenda</title>
</head>
<body>

<?php


/**
 * User has submitted form without errors and user's
 * account has been edited successfully.
 */
if (isset ($_SESSION['useredit'])) {
	unset ($_SESSION['useredit']);

	echo "<h1>User Account Edit Success!</h1>";
	echo '[<a href="../index.php">Main</a>]';
	echo "<p><b>$session->username</b>, your account has been successfully updated.</p>";
	echo '<p>Redirecting in 3 seconds...</p>';
} else {
	/**
	 * If user is not logged in, then do not display anything.
	 * If user is logged in, then display the form to edit
	 * account information, with the current email address
	 * already in the field.
	 */
	if ($session->logged_in) {
?>

<h1>User Account Edit : <?php echo $session->username; ?></h1>

<?php

		echo '[<a href="../index.php">Main</a>]';
		if ($form->num_errors > 0) {
			echo "<td><font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(s) found</font></td>";
		}
?>
<form action="process.php" method="post">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>Current Password:</td>
<td><input type="password" name="curpass" maxlength="30" value="
<?php echo $form->value("curpass"); ?>"></td>
<td><?php echo $form->error("curpass"); ?></td>
</tr>
<tr>
<td>New Password:</td>
<td><input type="password" name="newpass" maxlength="30" value="
<?php echo $form->value("newpass"); ?>"></td>
<td><?php echo $form->error("newpass"); ?></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="text" name="email" maxlength="50" value="
<?php


		if ($form->value("email") == "") {
			echo $session->userinfo['email'];
		} else {
			echo $form->value("email");
		}
?>">
</td>
<td><?php echo $form->error("email"); ?></td>
</tr>
<tr><td colspan="2" align="left">
<input type="checkbox" name="dailyreminders" value="dailyreminders" <?php if($session->usersettings['dailyreminders'])echo 'checked'; ?> />Send daily reminders 
</td></tr>
<tr><td colspan="2" align="left">
<input type="checkbox" name="includedeadlines" value="includedeadlines" <?php if($session->usersettings['includedeadlines'])echo 'checked'; ?> />Include deadlines in daily reminder
</td></tr>
<tr><td colspan="2" align="left">
<input type="checkbox" name="includetodo" value="includetodo" <?php if($session->usersettings['includetodo'])echo 'checked'; ?> />Include todo items in daily reminder
</td></tr>
<tr><td colspan="2" align="right">
<?php
echo 'Language preference: ';
		echo '<select name="language">';
		echo '<option value="Browser" ';
		if (!isset($session->usersettings['lang'])||$session->usersettings['lang'] == 'Browser') {
			echo 'selected';
		}
		echo '>Browser dependent</option>';
		
		foreach ($a_languages as $short=>$language) {
			echo '<option ';
			if ($session->usersettings['lang'] == $short) {
				echo 'selected ';
			}
			echo 'value="' . $short . '">' . $language . '</option>';
				
		}
		echo '</select>';
?>
</td></tr>

<tr><td colspan="2" align="right">
<select name="timezone">
<?php
foreach($timezonelist as $key => $value) {
	echo '<option ';
			if ($session->usersettings['timezone'] == $key) {
				echo 'selected ';
			}
	
	echo ' value="' . $key . '">' . $value . '</option>' . "\n";
}
?>
	</select>
</td></tr>

<tr><td colspan="2" align="right">
<input type="hidden" name="subedit" value="1">
<input type="submit" value="Edit Account"></td></tr>
<tr><td colspan="2" align="left"></td></tr>
</table>
</form>

<?php


	}
}
?>

</body>
</html>
