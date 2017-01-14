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
include ('../config.inc.php');
include ('../adodb/adodb.inc.php');
$db = ADONewConnection('mysql');
$db->Connect($dbhost, $dbuser, $dbpass, $dbname);
$db->debug = false;
$currentTime=time();
$sql="select ".$dbprefix."reminders.userid,".$dbprefix."reminders.eventid,".$dbprefix."reminders.time,".$dbprefix."events.title,".$dbprefix."events.description,".$dbprefix."events.date,".$dbprefix."users.email from ".$dbprefix."users,".$dbprefix."events,".$dbprefix."reminders where ".$dbprefix."reminders.userid=".$dbprefix."users.id and ".$dbprefix."reminders.eventid=".$dbprefix."events.id and ".$dbprefix."reminders.sent=0 and ".$dbprefix."reminders.time<".$currentTime;
$result=$db->Execute($sql);
$result->MoveFirst();
while(!$result->EOF){
 	$title=$result->fields['title'];
 	$email=$result->fields['email'];
 	$description=$result->fields['description'];
 	$date=$result->fields['date'];
 	//TODO filter email adress, make sure it is a single one
 	mail($email, "[PHP-agenda]".$title,"This is a reminder from your agenda: \n Date: ".date("F j, Y, g:i a",$date)."\nTitle:".$title."\nDescription: ".$description,"From: ".EMAIL_FROM_NAME." <".EMAIL_FROM_ADDR.">");
 	$sql='update ".$dbprefix."reminders set sent='.time().' where userid='.$result->fields['userid'].' and eventid='.$result->fields['eventid'].' and time='.$result->fields['time'];
 	$db->Execute($sql);
 	$result->MoveNext();
}
?>