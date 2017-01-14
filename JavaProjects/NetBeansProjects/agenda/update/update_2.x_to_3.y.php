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
include ("../adodb/adodb.inc.php");
include ('../config.inc.php');
$db = ADONewConnection('mysql'); # eg 'mysql' or 'postgres'
$db->Connect($dbhost, $dbuser, $dbpass, $dbname);
$db->debug = true;

$sql = "CREATE TABLE `".$dbprefix."event_target` (
`user_id` INT NOT NULL ,
`event_id` INT NOT NULL ,
PRIMARY KEY ( `user_id` , `event_id` ))";
	$db->Execute($sql);
	
	$sql = "CREATE TABLE `".$dbprefix."projects` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`parent` INT NOT NULL DEFAULT '-1',
`user_id` INT NOT NULL ,
`name` TEXT NOT NULL
)";
	$db->Execute($sql);
	
		$sql = "CREATE TABLE `".$dbprefix."taskproject` (
`project_id` INT NOT NULL ,
`task_id` INT NOT NULL ,
PRIMARY KEY ( `project_id` , `task_id` )
) ";
	
	$db->Execute($sql);
	$db->Close();