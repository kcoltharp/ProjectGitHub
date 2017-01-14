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
include ('../local_config_inc.php');
//create database
$db = ADONewConnection('mysql'); # eg 'mysql' or 'postgres'
$db->Connect($dbhost, $dbuser, $dbpass, $dbname);
$db->debug = true;
$db->Execute("ALTER TABLE `users` CHANGE `display_name` `username` VARCHAR( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL");
$db->Execute("ALTER TABLE `users` CHANGE `md5pass` `password` VARCHAR( 32 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL");
$db->Execute("ALTER TABLE `users` ADD `userid` VARCHAR( 32 ) NOT NULL ,ADD `userlevel` TINYINT( 1 ) DEFAULT '1' NOT NULL ,ADD `email` VARCHAR( 50 ) NOT NULL ,ADD `timestamp` INT( 11 ) NOT NULL ;");
$db->Execute("CREATE TABLE active_users (
			 username varchar(30) primary key,
			 timestamp int(11) unsigned not null
			);");

$db->Execute("CREATE TABLE active_guests (
			 ip varchar(15) primary key,
			 timestamp int(11) unsigned not null
			);");

$db->Execute("CREATE TABLE banned_users (
			 username varchar(30) primary key,
			 timestamp int(11) unsigned not null
			);");
$db->Close();

$data = '<?php' . "\n\t";
$data .= '$dbhost=\'' . $dbhost . "';\n\t";
$data .= '$dbname=\'' . $dbname . "';\n\t";
$data .= '$dbuser=\'' . $dbuser . "';\n\t";
$data .= '$dbpass=\'' . $dbpass . "';\n";

$data .= 'define("DB_SERVER", $dbhost)' . ";\n\t";
$data .= 'define("DB_USER", $dbuser)' . ";\n\t";
$data .= 'define("DB_PASS", $dbpass)' . ";\n\t";
$data .= 'define("DB_NAME", $dbname)' . ";\n\t";
$data .= 'define("TBL_USERS", "users")' . ";\n\t";
$data .= 'define("TBL_ACTIVE_USERS",  "active_users")' . ";\n\t";
$data .= 'define("TBL_ACTIVE_GUESTS", "active_guests")' . ";\n\t";
$data .= 'define("TBL_BANNED_USERS",  "banned_users")' . ";\n\t";
$data .= 'define("ADMIN_NAME", "admin")' . ";\n\t";
$data .= 'define("GUEST_NAME", "Guest")' . ";\n\t";
$data .= 'define("ADMIN_LEVEL", 9)' . ";\n\t";
$data .= 'define("USER_LEVEL",  1)' . ";\n\t";
$data .= 'define("GUEST_LEVEL", 0)' . ";\n\t";
$data .= 'define("TRACK_VISITORS", true)' . ";\n\t";
$data .= 'define("USER_TIMEOUT", 10)' . ";\n\t";
$data .= 'define("GUEST_TIMEOUT", 5)' . ";\n\t";
$data .= 'define("COOKIE_EXPIRE", 60*60*24*100)' . ";\n\t"; //100 days by default
$data .= 'define("COOKIE_PATH", "/")' . ";\n\t"; //Avaible in whole domain
$data .= 'define("EMAIL_FROM_NAME", "' . $_POST["fullname"] . '")' . ";\n\t";
$data .= 'define("EMAIL_FROM_ADDR", "' . $_POST["email"] . '")' . ";\n\t";
$data .= 'define("EMAIL_WELCOME", true)' . ";\n\t";
$data .= 'define("ALL_LOWERCASE", true)' . ";\n\t";
$data .= '?>';

$temp = 'config.inc.php'; #define temporary target name
$fp = fopen($temp, "w", 0) or die("Installation failed. Make sure config.inc.php is writable by the webserver."); #open for writing
fputs($fp, $data); #write all of $data to our opened file
fclose($fp); #close the file

echo "Please remove the file local_config_inc.php, the directory update and the file install.php for added security! These files can potentially damage your installation after the update."
?>
