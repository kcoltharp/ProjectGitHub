<?php
header('Content-type: text/html; charset=utf-8');

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
 * Copyright 2006-2009, Thomas Abeel
 * 
 * Project: http://sourceforge.net/projects/php-agenda/
 * 
 */
include ('auth/include/session.inc.php');
if (!$session->logged_in && !$allowGuestAccess) {
	header('Location: login.php');
	die();
}
// config.inc.php should be included by now
$dbNew = new DB($dbhost, $dbuser, $dbpass, $dbname);
$timeManager = new TimeManager($session);

/* Included languages */
include ('lang/lang.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title><?php echo $lang["title"];?></title>
  <link href="style.css.php" rel="stylesheet" type="text/css"/>
</head>
<body>
<h3>Project management</h3>
Note that subprojects are currently not supported. You can create them here, but they will not be available anywhere else.
<?php


echo '<form action="engine.php" method="post" >';
printTree("-1");
echo '<input checked type="radio" name="parent" value="-1">Create new root project!</input><br/>';
echo '<input type="input" name="name" /><br/>';
echo '<input type="hidden" name="action" value="addProject"/>';
echo '<input type="submit" value="Add"/><br/>';

echo '</form>';

function printTree($parent) {
	global $singleAgenda;
	global $dbNew;
	global $dbprefix;
	$sql = "select * from ".$dbprefix."projects where parent=$parent";
	if (!$singleAgenda) {
		$sql .= " and user_id=$session->id";
	}
	$arr = $dbNew->queryAsArray($sql);
	
	if (count($arr) > 0) {
		echo '<ul>';
		foreach ($arr as $row) {
			echo '<li><input checked type="radio" name="parent" value="'.$row['id'].'">'.h($row['name'])."</input></li>";
			printTree($row['id']);
		}
		echo '</ul>';
	}
}
?>

</body>



