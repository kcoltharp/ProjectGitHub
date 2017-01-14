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

$sql = 'select * from users';
$res = $db->Execute($sql);
$res->MoveFirst();
while (!$res->EOF) {
	$setting = unserialize($res->fields['settings']);
	$userNAME = $res->fields['username'];
	if ($setting['dailyreminders']) {
		echo 'Sending reminder for: '.$userNAME.'<br/>';
		$message="This is a reminder from your agenda: \n\n";
		//add appointments to the mail
		$currentTime = time();
		$current = mktime(0, 0, 0, date("m", $currentTime), date("d", $currentTime), date("Y", $currentTime));
		$next = mktime(0, 0, 0, date("m", $current), date("d", $current) + 1, date("Y", $current));
		$sql = "select * from ".$dbprefix."events,".$dbprefix."users where status!=1 and date>=$current and date<$next and user_id=".$dbprefix."users.id and username='" . $userNAME . "' order by dayevent desc,date asc ";
		$result = $db->Execute($sql)or die ($db->ErrorMsg());
		$result->MoveFirst();
		$email = $result->fields['email'];
		while (!$result->EOF) {
			$title = $result->fields['title'];
			$description = $result->fields['description'];
			$date = $result->fields['date'];
			//TODO filter email adress, make sure it is a single one
			$message.="Date: " . date("F j, Y, g:i a", $date) . "\nTitle:" . $title . "\nDescription: " . $description."\n\n";
			$result->MoveNext();
		}
		
		//add deadlines to the mail
		if($setting['includedeadlines']){
			$sql = "select * from ".$dbprefix."events,users where status=0 and deadline=1 and user_id=".$dbprefix."users.id and username='" . $userNAME . "' order by date asc";
			$recordSet = $db->Execute($sql)or die ($db->ErrorMsg());
			$message.="\nPending deadlines:\n";
			while (!$recordSet->EOF) {
					$message.="Date: ".date("F j, Y, g:i a", $recordSet->fields['date'])."\n";
					$message.="Title: ".$recordSet->fields['title']."\n";
					$message.="Description: ".$recordSet->fields['description']."\n\n";
					$recordSet->MoveNext();
			}
		}
		//add todo items to the mail
		if($setting['includetodo']){
			 $sql = "select * from ".$dbprefix."todo,users where status=0 and user_id=".$dbprefix."users.id and username='" . $userNAME . "' order by priority desc ";
			$recordSet = $db->Execute($sql)or die ($db->ErrorMsg());
			$message.="\nThings to do:\n";
			while (!$recordSet->EOF) {
					$message.="- ".$recordSet->fields['text']."\n";
					$recordSet->MoveNext();
			}
		}
		mail($email, "[PHP-agenda] Daily reminder" , $message , "From: " . EMAIL_FROM_NAME . " <" . EMAIL_FROM_ADDR . ">");
	}else{
		echo 'Skipping: '.$userNAME.'<br/>';
	}
	$res->MoveNext();
}
?>
