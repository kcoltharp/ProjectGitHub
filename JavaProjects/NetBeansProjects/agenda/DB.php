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
class DB {

	var $link;
	function __construct($dbhost, $dbuser, $dbpass, $dbname) {
		/* Connect or die */
		$this->link = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
		mysql_select_db($dbname) or die(mysql_error());
	}
	function __destruct() {
		mysql_close($this->link);
	}

	/* Prepare a string for database use */
	function s($string) {
		return mysql_real_escape_string($string, $this->link);
	}
	function addTODO($userid, $priority, $text, $project) {
		global $dbprefix;
		$sql = "insert into " . $dbprefix . "todo (`user_id`,`priority`,`text`,`added`) " .
		"values(" . DB :: s($userid) . "," . DB :: s($priority) . ",'" . DB :: s($text) . "'," . time() . ");";
		$id = $this->insert($sql);
		if ($project != "") {
			$pid = DB :: s($project);
			$sql = "insert into " . $dbprefix . "taskproject (project_id,task_id) values($pid,$id)";
			$this->query($sql);
		}
		return $this->error();

	}
	/*
	 * Executes an insert query and returns the insert ID.
	 */
	public function insert($sql) {
		$this->query($sql) or die(mysql_error($this->link));
		return mysql_insert_id($this->link);
	}

	/* 
	 * Executes a query against the database and return the result 
	 */
	function query($sql) {
		return mysql_query($sql, $this->link);

	}
	/*
	 * Returns the username for a user id
	 */
	function getUsername($id) {
		global $dbprefix;
		$sql = "select username from " . $dbprefix . "users where " . $dbprefix . "users.id=" . $this->s($id);
		$targets = $this->queryAsArray($sql);
		return $targets[0]['username'];
	}
	/*
	 * Returns an array of user indices that are a target for this event.
	 */
	function getTargets($event_id) {
		global $dbprefix;
		$sql = "select id from " . $dbprefix . "event_target," . $dbprefix . "users where " . $dbprefix . "users.id=" . $dbprefix . "event_target.user_id and event_id=" . $this->s($event_id);
		$targets = $this->queryAsArray($sql);
		$tar = array ();
		foreach ($targets as $row) {
			$tar[] = $row['id'];

		}
		return $tar;
	}

	/*
	 * Queries the DB with the supplied mysql query and returns the results as a matrix.
	 * 
	 * The SQL query needs to be sanitized before sending it here.
	 */
	function queryAsArray($sql) {
		$res = $this->query($sql) or die(mysql_error($this->link) . ', caused by: ' . htmlspecialchars($sql));
		$out = array ();
		while ($row = mysql_fetch_assoc($res)) {
			$out[] = $row;
		}
		return $out;
	}

	function error() {
		return mysql_error($this->link);
	}

}
?>