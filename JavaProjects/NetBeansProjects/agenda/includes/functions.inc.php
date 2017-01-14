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
function printTODOlist($db, $backgroundColors, $limit) {
	global $lang;
	global $allowGuestAccess;
	global $session;
	global $singleAgenda;
	global $dbprefix;
	global $enableProjectTracking;
	global $dbNew;
	$color[] = "#cceedd";
	$color[] = "#c8c8ff";
	$color[] = "#ffffb0";
	$color[] = "#ffd850";
	$color[] = "#ff50a8";
	$color[] = "#ff0000";

	$sql = "";
	if ($enableProjectTracking) { /* Project tracking */
		/* Currently we don't support nested projects */
		$sql = "select * from " . $dbprefix . "projects where parent=-1";
		if (!$singleAgenda) {
			$sql .= " and user_id=$session->id";
		}
		$arr = $dbNew->queryAsArray($sql);
		if (count($arr) > 0) {
			foreach ($arr as $row) {
				$projectid = $row['id'];
				$sql = "select *, " . $dbprefix . "todo.id as tid from " . $dbprefix . "todo," . $dbprefix . "taskproject," . $dbprefix . "projects where " . $dbprefix . "projects.id=$projectid and " . $dbprefix . "taskproject.project_id=" . $dbprefix . "projects.id and " . $dbprefix . "taskproject.task_id=" . $dbprefix . "todo.id and status=0 ";
				if ($session->logged_in && !$singleAgenda) {
					$sql .= " and user_id=" . $session->id;
				}
				$sql .= " order by priority desc limit 0," . $limit;
				$arr2 = $dbNew->queryAsArray($sql);
				if (count($arr2) > 0) {
					echo '<div class="total-box">';
					echo '<div class="title">';
					echo '<strong>' . h($row['name']) . '</strong></div>';
					
					echo '<div class="main">';
					
					
					

					foreach ($arr2 as $row2) {
						echo '<div class="todo">';

						$todoid = h($row2['tid']);
						$priority = h($row2['priority']);
						echo '<div style="';
						if ($backgroundColors) {
							echo 'background-color:' . $color[$priority] . ';';
						}
						echo 'width: 100%;">';
						if ($priority < 5)
							$upprior = $priority +1;
						else
							$upprior = $priority;

						if ($priority > 0)
							$downprior = $priority -1;
						else
							$downprior = $priority;

						echo "<a onclick=\"javascript:return confirm('" . $lang['certainfinish'] . "')\" href=\"?finishTODO=$todoid\"><img height='100%' src=\"img/finished.png\" alt=\"finish\" /></a>";
						echo "<a onclick=\"javascript:return confirm('" . $lang['certainremove'] . "')\" href=\"?deleteTODO=$todoid\"><img height='100%' src=\"img/deleteTODO.png\" alt=\"delete\" /></a>";
						echo "<a href=\"?newprior=$upprior&amp;eventid=$todoid\"><img height='100%' src=\"img/uparrow.png\" alt=\"up\" /></a>";
						echo "<a href=\"?newprior=$downprior&amp;eventid=$todoid\"><img height='100%' src=\"img/downarrow.png\" alt=\"down\" /></a>";

						echo " " . h($row2['text']);

						echo "</div>";
						echo '</div>';
					}
					
					echo '</div>';
					echo '</div>';
				}
			}
		}
		$sql = "SELECT *, " . $dbprefix . "todo.id as tid
						FROM " . $dbprefix . "_todo
						LEFT OUTER JOIN " . $dbprefix . "taskproject ON " . $dbprefix . "todo.id = " . $dbprefix . "taskproject.task_id where task_id is NULL and status=0  order by priority desc limit 0," . $limit;
		if ($session->logged_in && !$singleAgenda) {
			$sql .= " and user_id=" . $session->id;
		}
		$arr = $dbNew->queryAsArray($sql);
		if (count($arr) > 0) {
			echo '<div class="total-box">';
					echo '<div class="title">';
			echo '<strong>Uncategorized</strong></div>';
			echo '<div class="main">';

			foreach ($arr as $row) {
				echo '<div class="todo">';

				$todoid = h($row['tid']);
				$priority = h($row['priority']);
				echo '<div style="';
				if ($backgroundColors) {
					echo 'background-color:' . $color[$priority] . ';';
				}
				echo 'width: 100%;">';
				if ($priority < 5)
					$upprior = $priority +1;
				else
					$upprior = $priority;

				if ($priority > 0)
					$downprior = $priority -1;
				else
					$downprior = $priority;

				echo "<a onclick=\"javascript:return confirm('" . $lang['certainfinish'] . "')\" href=\"?finishTODO=$todoid\"><img height='100%' src=\"img/finished.png\" alt=\"finish\" /></a>";
				echo "<a onclick=\"javascript:return confirm('" . $lang['certainremove'] . "')\" href=\"?deleteTODO=$todoid\"><img height='100%' src=\"img/deleteTODO.png\" alt=\"delete\" /></a>";
				echo "<a href=\"?newprior=$upprior&amp;eventid=$todoid\"><img height='100%' src=\"img/uparrow.png\" alt=\"up\" /></a>";
				echo "<a href=\"?newprior=$downprior&amp;eventid=$todoid\"><img height='100%' src=\"img/downarrow.png\" alt=\"down\" /></a>";

				echo " " . h($row['text']);

				echo "</div>";
				echo '</div>';
			}
			echo '</div>';
			echo '</div>';
		}

	} else { /* No project tracking */
		echo '<div class="box">';
		echo '<div style="text-align: center;">';
		echo '<h4><a href="?page=todo">' . $lang['right-todo'] . '</a></h4></div>';
		if ($session->logged_in && !$singleAgenda) {
			$sql = "select * from " . $dbprefix . "todo where status=0 and user_id=" . $session->id . " order by priority desc limit 0," . $limit;
		} else
			$sql = "select * from " . $dbprefix . "todo where status=0 order by priority desc limit 0," . $limit;
		if ($sql != "") {
			$recordSet = & $db->Execute($sql);
			while (!$recordSet->EOF) {
				echo '<div class="todo">';
				$todoid = $recordSet->fields["id"];
				$priority = $recordSet->fields["priority"];
				echo '<div style="';
				if ($backgroundColors) {
					echo 'background-color:' . $color[$priority] . ';';
				}
				echo 'width: 100%;">';
				if ($priority < 5)
					$upprior = $priority +1;
				else
					$upprior = $priority;

				if ($priority > 0)
					$downprior = $priority -1;
				else
					$downprior = $priority;

				echo "<a onclick=\"javascript:return confirm('" . $lang['certainfinish'] . "')\" href=\"?finishTODO=$todoid\"><img height='100%' src=\"img/finished.png\" alt=\"finish\" /></a>";
				echo "<a onclick=\"javascript:return confirm('" . $lang['certainremove'] . "')\" href=\"?deleteTODO=$todoid\"><img height='100%' src=\"img/deleteTODO.png\" alt=\"delete\" /></a>";
				echo "<a href=\"?newprior=$upprior&amp;eventid=$todoid\"><img height='100%' src=\"img/uparrow.png\" alt=\"up\" /></a>";
				echo "<a href=\"?newprior=$downprior&amp;eventid=$todoid\"><img height='100%' src=\"img/downarrow.png\" alt=\"down\" /></a>";

				echo " " . $recordSet->fields["text"];

				echo "</div>";
				echo '</div>';
				$recordSet->MoveNext();
			}
		}
		echo '</div>';
	}
}