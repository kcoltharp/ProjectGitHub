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
$now = time();
include ('../auth/include/session.inc.php');

if (isset ($_SESSION['current'])) {
	$current = $_SESSION['current'];
} else {
	$current = mktime(0, 0, 0, date("m", $now), date("d", $now), date("Y", $now));
}
$timeManager = new TimeManager($session);

if (isset ($_GET['day'])) {
	$dtime = $timeManager->getLocalDateTime($current);
	$dtime->modify(h($_GET['day']) . " days");
	$_SESSION['current'] = $dtime->format('U');
}
elseif (isset ($_GET['week'])) {
	$dtime = $timeManager->getLocalDateTime($current);
	$dtime->modify(h($_GET['week']) . " weeks");
	$_SESSION['current'] = $dtime->format('U');
}
elseif (isset ($_GET['month'])) {
	$dtime = $timeManager->getLocalDateTime($current);
	$dtime->modify(h($_GET['month']) . " months");
	$_SESSION['current'] = $dtime->format('U');
}
elseif (isset ($_GET['year'])) {
	$dtime = $timeManager->getLocalDateTime($current);
	$dtime->modify(h($_GET['year']) . " years");
	$_SESSION['current'] = $dtime->format('U');
}
$now = time();
if (isset ($_POST["goto"])) {
	$date = $_POST["date"];
	if(strlen($date)>0){
		list ($year, $month, $day) = split("-", $date);
		$_SESSION['current'] = $timeManager->getUnix($year, $month, $day);
	}
	
}

if (isset ($_GET['timestamp'])) {
	$_SESSION['current'] = h($_GET['timestamp']);
}
if (isset ($_GET['date'])) {
	$date = $_GET['date'];
	list ($year, $month, $day) = split("-", $date);
	$_SESSION['current'] = $timeManager->getUnix($year, $month, $day);

	//	$_SESSION['current'] = mktime(0, 0, 0, $month, $day, $year);
}
//echo $_SESSION['current'].'<br>';
header('Location: ' . $session->referrer);
?>

