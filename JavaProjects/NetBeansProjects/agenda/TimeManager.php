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

class TimeManager {

 	function getDataTimeZone() {
		if (isset ($this->session->usersettings['timezone']) && !empty ($this->session->usersettings['timezone']))
			return new DateTimeZone($this->session->usersettings['timezone']);
		else
			return new DateTimeZone("UTC");
	}
	private $session;
	function __construct($session) {
		$this->session = $session;
	}
	
	function getLocalDateTime($timestamp){
		$dtzone=$this->getDataTimeZone();
		$time = date('r', $timestamp);
		// now create the DateTime object for this time
		$dtime = new DateTime($time);
		// convert this to the user's timezone using the DateTimeZone object
		$dtime->setTimeZone($dtzone);
		return $dtime;
		
	}
	function getUnix($year, $month, $day = 1, $hour = 0, $minute = 0, $seconds = 1) {

		/* Get the user timezone */
		$dtzone=$this->getDataTimeZone();
		// now create the DateTime object for this time and user time zone
		$dtime = date_create($year . '/' . $month . '/' . $day . ' ' . $hour . ':' . $minute . ':' . $seconds, $dtzone);

		// print the timestamp
		return $dtime->format('U');
	}

	/* Get the start of the day that contains the provided second */
	function getStart($timestamp, $daysoffset = 0) {
		$dtzone=$this->getDataTimeZone();
		$time = date('r', $timestamp);
		// now create the DateTime object for this time
		$dtime = new DateTime($time);

		// convert this to the user's timezone using the DateTimeZone object
		$dtime->setTimeZone($dtzone);
		/* 
		 * Work around for bugged PHP versions <5.2.3 
		 * 
		 * $dtime->setTime(0, 0, 0);
		 */
//		 $dtime->setTime(0, 0, 0);
		$hours=$dtime->format('G');
		$minutes=$dtime->format('i');
		$seconds=$dtime->format('s');
		$dtime->modify("-$hours hours");
		$dtime->modify("-$minutes minutes");
		$dtime->modify("-$seconds seconds");
		
		if ($daysoffset != 0)
			$dtime->modify("+$daysoffset day");
		return $dtime->format('U');

	}

	/* Get the end of the day that contains the provided second */
	function getEnd($timestamp, $daysoffset = 0) {
		$dtzone=$this->getDataTimeZone();
		$time = date('r', $timestamp);
		// now create the DateTime object for this time
		$dtime = new DateTime($time);
		// convert this to the user's timezone using the DateTimeZone object
		$dtime->setTimeZone($dtzone);
		/* 
		 * Work around for bugged PHP versions <5.2.3 
		 * 
		 * $dtime->setTime(0, 0, 0);
		 */
//		 $dtime->setTime(0, 0, 0);
		$hours=$dtime->format('G');
		$minutes=$dtime->format('i');
		$seconds=$dtime->format('s');
		$dtime->modify("-$hours hours");
		$dtime->modify("-$minutes minutes");
		$dtime->modify("-$seconds seconds");
		
		
		$dtime->modify("+1 day");
		if ($daysoffset != 0)
			$dtime->modify("+$daysoffset day");
		return $dtime->format('U');
	}

	function hm($timestamp) {
		$dtzone=$this->getDataTimeZone();

		$time = date('r', $timestamp);

		// now create the DateTime object for this time
		$dtime = new DateTime($time);

		// convert this to the user's timezone using the DateTimeZone object
		$dtime->setTimeZone($dtzone);

		// print the time using your preferred format
		return $dtime->format('G:i');

	}

	function w($timestamp) {
		$dtzone=$this->getDataTimeZone();

		$time = date('r', $timestamp);

		// now create the DateTime object for this time
		$dtime = new DateTime($time);

		// convert this to the user's timezone using the DateTimeZone object
		$dtime->setTimeZone($dtzone);

		// print the time using your preferred format
		return $dtime->format('w');
	}

	function j($timestamp) {
		$dtzone=$this->getDataTimeZone();

		$time = date('r', $timestamp);

		// now create the DateTime object for this time
		$dtime = new DateTime($time);

		// convert this to the user's timezone using the DateTimeZone object
		$dtime->setTimeZone($dtzone);

		// print the time using your preferred format
		return $dtime->format('j');
	}
	function ymd($timestamp) {
		$dtzone=$this->getDataTimeZone();

		$time = date('r', $timestamp);

		// now create the DateTime object for this time
		$dtime = new DateTime($time);

		// convert this to the user's timezone using the DateTimeZone object
		$dtime->setTimeZone($dtzone);

		// print the time using your preferred format
		return $dtime->format('l, j F, Y');
	}

}
?>
