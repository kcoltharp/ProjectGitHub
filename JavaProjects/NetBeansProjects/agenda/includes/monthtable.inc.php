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
?>
<?php

function printmonthtable($offset, $db) {
	global $timeManager;
	//$now=time();
	$dtime=$timeManager->getLocalDateTime(time());
	$month = new DateTime($dtime->format('Y-m'),$timeManager->getDataTimeZone());
	
	$month->modify("+".$offset." months");
	$nextMonth=new DateTime($dtime->format('Y-m'),$timeManager->getDataTimeZone());
	$nextMonth->modify("+".$offset." months");
	$nextMonth->modify('+1 month');
	//BUGHACK FOR PHP <5.2.3, where day is not properly set to 1.
	$day=$month->format('d');
	$month->modify("-$day days");
	$month->modify("+1 days");
	$nextMonth->modify("-$day days");
	$nextMonth->modify("+1 days");
	//END BUGHACK
	
	
	$startpos = $month->format("w");
	if ($startpos == 0) {
		$startpos = 7;
	}
	
	
	echo '<table width="100%">';
	echo '<tr><td colspan="7" align="center"><b><a href="?page=overview&amp;type=month&amp;offset=' . $offset . '">' . $month->format("F - Y") . '</a></b></td></tr>';
	for ($i = 1;($month->format("m") != $nextMonth->format('m')); $i++) {
		echo '<tr>';
		for ($j = 1; $j <= 7; $j++) {
			if (($i == 1 and $j < $startpos) or ($month->format("m") == $nextMonth->format('m')) ){
				echo '<td>&nbsp;</td>';
			} else {
				$backcolor = '#ffffff';
				if (hasAppointments($db, $month->format('U'))) {
					$backcolor = '#ff0000';
				}
				if ($dtime->format("Y-m-d")== $month->format("Y-m-d")) {
					$daymark = 'blue';
				} else {
					$daymark = 'white';
				}
				if ($j >= 6) {
					echo '<td bgcolor=' . $daymark . '><span 
					style="background: ' . $backcolor . ';"><b><a 
					href="engine/changedate.php?date=' . $month->format("Y-m-
					d") . '">' . $month->format("d"). '</a></b></span></td>';
				} else {
					echo '<td bgcolor=' . $daymark . '><span 
					style="background: ' . $backcolor . ';"><a 
					href="engine/changedate.php?date=' . $month->format("Y-m-
					d") . '">' . $month->format("d") . '</a></span></td>';
				}
			}
			if ($i != 1 or $j >= $startpos) {
				$month->modify('+1 day');
				
			}
		}
		echo '</tr>';

	}
	echo '</table>';
}
function hasAppointments($database, $timestamp) {
	global $session;
	global $singleAgenda;
	global $dbprefix;
	global $timeManager;
	$start=$timeManager->getStart($timestamp);
	$end=$timeManager->getEnd($timestamp);
	
	if ($session->logged_in && !$singleAgenda) {
		$sql = "select * from ".$dbprefix."events where status!=1 and date>=$start and date<$end and user_id=" . $session->id . " order by date asc";
	} else {
		$sql = "select * from ".$dbprefix."events where status!=1 and date>=$start and date<$end order by date asc";
	}
	//echo $sql."<br>";
	$recordYSet = & $database->Execute($sql);
	$count = 0;

	while (!$recordYSet->EOF) {
		$count++;
		$recordYSet->MoveNext();

	}
	return $count > 0;
}