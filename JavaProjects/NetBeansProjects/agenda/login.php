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

include ("auth/include/session.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <link href="style.css.php" rel="stylesheet" type="text/css"/>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <?php
  if ($session->logged_in) {
  	echo '<meta http-equiv="refresh" content="1;url=index.php">';
  }
  ?>
  <title>The Simple PHP Agenda</title>
</head>
<body>

<?php

/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if ($session->logged_in) {
	echo "<h1>Logged In</h1>";
	echo "Welcome <b>$session->username</b>, you are logged in. [<a href='index.php'>Proceed to the agenda.</a>]<br>You will be automatically redirected in 1 second.<br/><br/>" .
	"[<a href=\"auth/userinfo.php?user=$session->username\">My Account</a>] &nbsp;&nbsp;" .
	"[<a href=\"auth/useredit.php\">Edit Account</a>] &nbsp;&nbsp;";
	if ($session->isAdmin()) {
		echo "[<a href=\"auth/admin/admin.php\">Admin Center</a>] &nbsp;&nbsp;";
	}
	echo "[<a href=\"auth/process.php\">Logout</a>]";
} else {
?>


<?php

	/**
	 * User not logged in, display the login form.
	 * If user has already tried to login, but errors were
	 * found, display the total number of errors.
	 * If errors occurred, they will be displayed.
	 */
	if ($form->num_errors > 0) {
		echo "<font size=\"2\" color=\"#ff0000\">" . $form->num_errors . " error(s) found</font>";
	}
?>
<div id="loginbox">
<h1>Login</h1>
<form action="auth/process.php" method="post">
<label for="user">Username:</label><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>" /><?php echo $form->error("user"); ?><br /><br />
<label for="pass">Password:</label><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>" /><?php echo $form->error("pass"); ?><br /><br />
<input type="hidden" name="sublogin" value="1" />
<p><input id="loginsubmit" type="submit" name="logIn" value="Login"/></p>
</form>
<font size="2">[<a href="auth/forgotpass.php">Forgot Password?</a>]
<?php
if($allowSignUp){
	echo ' [<a href="auth/register.php">Sign-Up</a>]';
}
?>
</font>

</div>

<?php

}//end else
?>
</body>
</html>
