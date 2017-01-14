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
include ("../adodb/adodb.inc.php");
include ('../config.inc.php');
$db = ADONewConnection('mysql'); # eg 'mysql' or 'postgres'
$db->Connect($dbhost, $dbuser, $dbpass, $dbname);
$db->debug = true;

$db->Execute("ALTER TABLE `events` DROP `reminder`;");

$sql = "CREATE TABLE `reminders` (
			`userid` INT NOT NULL ,
			`eventid` INT NOT NULL ,
			`time` INT NOT NULL ,
			`sent` INT NOT NULL DEFAULT '0',
			PRIMARY KEY ( `userid` , `eventid`,`time` )
		)";
$db->Execute($sql);

$sql = "ALTER TABLE `users` ADD `settings` TEXT NOT NULL";
$db->Execute($sql);

?>