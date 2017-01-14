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
 * Copyright 2006-2009, Thomas Abeel
 * 
 * Project: http://sourceforge.net/projects/php-agenda/
 * 
 */
include ('auth/include/session.inc.php');
include ('lang/lang.inc.php');
if (!$session->logged_in) {
	header('Location: login.php');
	die();
}
$db = new DB($dbhost, $dbuser, $dbpass, $dbname);
$timeManager = new TimeManager($session);
$messages = array ();

$url = "index.php";
switch ($_POST['action']) {
	case "addTODO" :
		addTODO($db, $session, $_POST['priority'], $_POST['text'],$_POST['project'], $messages);
		break;
	case "addEvent" :
		addEvent($db, $session, $messages);
		break;
	case "addProject" :
		addProject($db, $session, $messages);
		$url = "projectmanagement.php";
		break;
	default :
		//Do nothing
		break;
}
/* Output messages */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=ISO-8859-1" />
  <title><?php echo $lang["title"];?></title>
  <link href="engine.css.php" rel="stylesheet" type="text/css"/>
  <meta http-equiv="refresh" content="1;url=<?php echo $url;?>" />
</head>
<body>

<div id="box">
<?php


echo '<ul>';
foreach ($messages as $message) {
	echo '<li>' . $message[0] . ": " . $message[1] . '</li>';
}
echo '</ul>';

function addProject($db, $session, array & $messages) {
	global $dbprefix;
	$parent = $db->s($_POST['parent']);
	$name = $db->s($_POST['name']);
	$sql = "insert into " . $dbprefix . "projects (parent,name,user_id) values($parent,'$name'," . $session->id . ")";
	$insertid = $db->insert($sql);
	$messages[] = array (
		"Message",
		"Added project"
	);
}

function addTODO($db, $session, $priority, $text,$project, array & $messages) {
	$ret = $db->addTODO($session->id, $priority, $text,$project);
	if ($ret !="")
		$messages[] = array (
			"Error",
			$ret
		);
	else
		$messages[] = array (
			"Message",
			"TODO item succesfully added"
		);

}
function addEvent($db, $session, array & $messages) {
	global $dbprefix;
	global $timeManager;
	$deadline = 0;
	if (isset ($_POST["deadline"])) {
		$deadline = 1;
	}
	$dayevent = 0;
	if (isset ($_POST["dayevent"])) {
		$dayevent = 1;
	}
	/*
	 * Get the date from the post variables. 
	 * If no date is set, use the current day
	 */
	$dtzone = $timeManager->getDataTimeZone();
	$time = date('r', $_SESSION['current']);
	$dtime = new DateTime($time);
	$dtime->setTimeZone($dtzone);

	$tmp_date = "";
	if (isset ($_POST["date"]))
		$tmp_date = $_POST["date"];
	if ($tmp_date != "") {
		list ($tmp_year, $tmp_month, $tmp_day) = split("-", $tmp_date);
		$dtime = new DateTime($tmp_date, $timeManager->getDataTimeZone());

	}
	/*
	 * Get the time from the post variables.
	 * If there is no time set, consider this to be a daylong event.
	 */
	$tmp_time = "";
	if (isset ($_POST["time"]))
		$tmp_time = $_POST["time"];

	if ($tmp_time != "") {
		list ($tmp_hour, $tmp_minute) = split(":", $tmp_time);
		//FIX $dtime->setTime($tmp_hour,$tmp_minute,0);
		$dtime = new DateTime($dtime->format("Y-m-d") . ', ' . $tmp_time, $timeManager->getDataTimeZone());
	} else {

		$dayevent = 1;
	}

	$title = $db->s($_POST["title"]);
	$description = $db->s($_POST["description"]);

	if ($title != "") {
		$insertID = $db->insert("insert into " . $dbprefix . "events (`user_id`,`date`,`title`,`description`,`added`,`deadline`,`dayevent`) " .
		"values(" . $session->id . "," . $dtime->format('U') . ",'$title','$description'," . time() . ",$deadline,$dayevent);");
		if (isset ($_POST['targets']) && is_array($_POST['targets'])) {
			foreach ($_POST['targets'] as $target) {
				$targetID = $db->s($target);
				$db->insert("insert into " . $dbprefix . "event_target(`user_id`,`event_id`) values($targetID,$insertID)");
			}
		}
		if (isset ($_POST["x1day"])) {
			$dtime->modify("-1 day");
			$db->insert("insert into " . $dbprefix . "reminders (`userid`,`eventid`,`time`) values (" . $session->id . "," . $insertID . "," . $dtime->format('U') . ")");
			$dtime->modify("+1 day");
		}
		if (isset ($_POST["x3hour"])) {
			$dtime->modify("-3 hours");
			$db->insert("insert into " . $dbprefix . "reminders (`userid`,`eventid`,`time`) values (" . $session->id . "," . $insertID . "," . $dtime->format('U') . ")");
			$dtime->modify("+3 hours");
		}
		if (isset ($_POST["x1hour"])) {
			$dtime->modify("-1 hour day");
			$db->insert("insert into " . $dbprefix . "reminders (`userid`,`eventid`,`time`) values (" . $session->id . "," . $insertID . "," . $dtime->format('U') . ")");
			$dtime->modify("+1 day");
		}
		if (isset ($_POST["x15min"])) {
			$dtime->modify("-15 minutes day");
			$db->insert("insert into " . $dbprefix . "reminders (`userid`,`eventid`,`time`) values (" . $session->id . "," . $insertID . "," . $dtime->format('U') . ")");
			$dtime->modify("-15 minutes day");
		}
		unset ($_POST["newEvent"]);

	}
	$err = $db->error();
	if ($err != "")
		$messages[] = array (
			"Error",
			$err
		);
	else
		$messages[] = array (
			"Message",
			"Event succesfully added"
		);
}
?>
</div>
</body>
</html>