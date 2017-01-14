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

function cb ($id) {
	global $dbNew;
	return $dbNew->getUsername($id);
};
function printAppointmentHTML($arr) {
	global $lang;
	global $enableEventTargetting;
	global $dbNew;
	global $session;
	global $timeManager;
	$deadlineHTML = "";
	if ($arr['deadline'] == "1")
		$deadlineHTML = '<img alt="deadline" src="img/deadline.gif"/>';
	if ($arr['dayevent'] == "0")
		echo '<td width="15%" align="right">' . $deadlineHTML . $timeManager->hm($arr['date']) . '</td>';
	else
		echo '<td width="15%" align="right">' . $deadlineHTML . '<img alt="dayevent" src="img/clock.png"/></td>';

	$target = "";
	$targetStyle = "";
	if ($enableEventTargetting) {

		$tar = $dbNew->getTargets($arr['id']);
		if (sizeof($tar) > 0) {
			$cb = $names = array_map('cb', $tar);
			$target = "(" . implode(", ", $names) . ")";
			if (in_array($session->id, $tar)) {
				$targetStyle = ' style="background-color:#ffc" ';
			}
		}

	}
	echo '<td ' . $targetStyle . ' align="left">';
	if (isURL($arr['description'])) {
		echo '<a title="' . h($arr['description']) . '" href="' . h($arr['description']) . '">' . h($arr['title']) . ' ' . $target . '</a>';
	} else {

		echo '<span title="' . h($arr['description']) . '">' . h($arr['title']) . ' ' . $target . '</span>';
	}
	echo '</td>';
	echo '<td width="10%" align="right"><a href="edit_event.php?eventid=' . h($arr['id']) . '"><img src="img/edit.png" alt="edit"/></a><a href="?deleteEvent=' . h($arr['id']) . '" onClick="javascript:return confirm(\'' . $lang['certainremove'] . '\')"><img src="img/delete.png" alt="delete"/></a></td>';

}

include (dirname(__FILE__) . '/navlinks.inc.php');
echo '<div class="box">';
echo '<h3>' . $lang["index-appointments"] . '</h3>';

$start=$timeManager->getStart($_SESSION['current'],0);
$end=$timeManager->getEnd($_SESSION['current'],0);

if ($session->logged_in && !$singleAgenda) {
	$sql = "select distinct * from " . $dbprefix . "events where status!=1 and date>=$start and date<$end and user_id=" . $session->id . " order by dayevent desc,date asc ";
} else {
	$sql = "select distinct * from " . $dbprefix . "events where status!=1 and date>=$start and date<$end order by dayevent desc,date asc ";
}

$arr = $dbNew->queryAsArray($sql);
echo '<table width="100%">';

foreach ($arr as $row) {
	echo '<tr>';
	printAppointmentHTML($row);
	echo '</tr>';

}
echo '<tr><td colspan="2"><b>' . $lang['legend'] . ':</b><br/><img alt="dayevent" src="img/clock.png"/> ' . $lang['legend-daylong'] . '&nbsp;<img alt="deadline" src="img/deadline.gif"/> ' . $lang['legend-deadline'] . '</td></tr>';
echo '</table>';
echo '</div>';
?>