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
 * Register.php
 * 
 * Displays the registration form if the user needs to sign-up,
 * or lets the user know, if he's already logged in, that he
 * can't register another name.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
include ("include/session.inc.php");

/**
 * If not logged in as admin and it is not allowed to register, redirect to login page.
 */
if (!$session->isAdmin() && !$allowSignUp) {
	header("Location: ../login.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title>The Simple PHP Agenda</title>
</head>
<body>

<?php


/**
 * The user is already logged in, not allowed to register.
 */
if ($session->logged_in && !$session->isAdmin()) {
	echo "<h1>Registered</h1>";
	echo "<p>We're sorry <b>$session->username</b>, but you've already registered. " .
	"<a href=\"../index.php\">Main</a>.</p>";
}

/**
 * The user has submitted the registration form and the
 * results have been processed.
 */
else
	if (isset ($_SESSION['regsuccess'])) {
		/* Registration was successful */
		if ($_SESSION['regsuccess']) {
			echo "<h1>Registered!</h1>";
			echo "<p>Thank you <b>" . $_SESSION['reguname'] . "</b>, your information has been added to the database, " .
			"you may now <a href=\"../index.php\">log in</a>.</p>";
		}
		/* Registration failed */
		else {
			echo "<h1>Registration Failed</h1>";
			echo "<p>We're sorry, but an error has occurred and your registration for the username <b>" . $_SESSION['reguname'] . "</b>, " .
			"could not be completed.<br>Please try again at a later time.</p>";
		}
		unset ($_SESSION['regsuccess']);
		unset ($_SESSION['reguname']);
	}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else {
?>

<h1>Register</h1>
<?php

	if ($form->num_errors > 0) {
		echo "<td><font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(s) found</font></td>";
	}
?>
<form action="process.php" method="post">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"></td><td><?php echo $form->error("user"); ?></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"></td><td><?php echo $form->error("pass"); ?></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"></td><td><?php echo $form->error("email"); ?></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subjoin" value="1">
<input type="submit" value="Join!"></td></tr>
<tr><td colspan="2" align="left"><a href="../index.php">Back to Main</a></td></tr>
</table>
</form>

<?php

}
?>

</body>
</html>
