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
include (dirname(__FILE__) . '/navlinks.inc.php');
if (isset ($_GET['type'])) {
	$begin;
	$end;
	if ($_GET['type'] == 'week') {
		$weekday = date("w", $current);

		$begin = mktime(0, 0, 0, date("m", $current), date("d", $current) - $weekday, date("Y", $current));
		$end = mktime(0, 0, 0, date("m", $current), date("d", $current) - $weekday +7, date("Y", $current));

	} else
		if ($_GET['type'] == 'month') {
			if (isset ($_GET['offset'])) {
				$begin = mktime(0, 0, 0, date("m", $current) + $_GET['offset'], 1, date("Y", $current));
				$end = mktime(0, 0, 0, date("m", $current) + $_GET['offset'] + 1, 0, date("Y", $current));
			} else {
				$begin = mktime(0, 0, 0, date("m", $current), 1, date("Y", $current));
				$end = mktime(0, 0, 0, date("m", $current) + 1, 0, date("Y", $current));

			}

		} else
			if ($_GET['type'] == 'year') {
				$begin = mktime(0, 0, 0, 1, 1, date("Y", $current));
				$end = mktime(0, 0, 0, 1, 1, date("Y", $current) + 1);

			} else {
				header('Location:index.php');
			}

	printRange($begin, $end);
} else {
	header('Location:index.php');
}
function cb ($id) {
	global $dbNew;
	return $dbNew->getUsername($id);
};
function printRange($begin, $end) {
	global $lang;
	global $db;
	global $session;
	global $singleAgenda;
	global $enableEventTargetting;
	global $dbNew;
	global $dbprefix;
	echo '<div class="box">';
	echo '<h3>' . $lang['range-appointments'] . ': ' . date('d-M-Y', $begin) . ' ' . $lang['index-overviewtill'] . ' ' . date('d-M-Y', $end) . '</h3>';
	if ($session->logged_in && !$singleAgenda) {
		$sql = "select distinct * from ".$dbprefix."events where status!=1 and date>=$begin and date<$end and user_id=" . $session->id . " order by date asc ";
	} else {
		$sql = "select distinct * from ".$dbprefix."events where status!=1 and date>=$begin and date<$end order by date asc ";
	}
	$recordXSet = $db->Execute($sql);
	echo '<table width="100%">';
	echo '<tr>';
	while (!$recordXSet->EOF) {

		$eventid = $recordXSet->fields["id"];
		$deadline = "";
		echo '<td width="15%"><a href="engine/changedate.php?date=' . date("Y-m-d", $recordXSet->fields["date"]) . '">' . date('Y-M-d', $recordXSet->fields["date"]) . '</a></td>';
		if ($recordXSet->fields["deadline"] == 1)
			$deadline = '<img alt="deadline" src="img/deadline.gif"/>';
		if ($recordXSet->fields["dayevent"] == 0)
			echo '<td width="10%" align="right">' . $deadline . date("H:i", $recordXSet->fields["date"]) . '</td>';
		else
			echo '<td width="10%" align="right">' . $deadline . '<img alt="dayevent" src="img/clock.png"/></td>';
		$target="";
		$targetStyle="";
		if ($enableEventTargetting) {
			$tar = $dbNew->getTargets($recordXSet->fields["id"]);
			
			if (sizeof($tar) > 0) {
				$names = array_map('cb', $tar);
				$target = "(" . implode(", ", $names) . ")";
				if (in_array($session->id, $tar)) {
					$targetStyle = ' style="background-color:#ffc" ';
				}
		}
		}
		echo '<td '.$targetStyle.' align="left"><span title="' . $recordXSet->fields["description"] . '">' . $recordXSet->fields["title"] . ' ' . $target . "</span></td>";
		echo '<td width="10%" align="right"><a href="edit_event.php?eventid=' . $eventid . '"><img src="img/edit.png" alt="edit"/></a><a href="?deleteEvent=' . $eventid . '" onClick="javascript:return confirm(\'' . $lang['certainremove'] . '\')"><img src="img/delete.png" alt="delete"/></a></td>';
		echo '</tr>';
		$recordXSet->MoveNext();
	}
	echo '<tr><td colspan="2"><b>' . $lang['legend'] . ':</b><br/><img alt="dayevent" src="img/clock.png"/> ' . $lang['legend-daylong'] . '<br/><img alt="deadline" src="img/deadline.gif"/> ' . $lang['legend-deadline'] . '</td></tr>';
	echo '</table>';
	echo '</div>';
}
?>