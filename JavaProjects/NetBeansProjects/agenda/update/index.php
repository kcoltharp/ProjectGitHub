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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title>The Simple PHP Agenda</title>
<style>
<!--
pre          { font-family: Verdana; font-size: 8pt }
td           { font-family: Verdana; font-size: 8pt }
p            { font-family: Verdana; font-size: 8pt }
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<br>
<h1>PHP Agenda upgrade center</h1>
<p align=center><b>Available update scripts</b></p>
<p align=center><b>Please backup your data before executing any of these scripts! We cannot be held responsible for any losses or damages cause by this scripts.</b></p>
<p align=center><b>These script are only suited to update an existing installation! Please use the <a href="../install.php">install script</a> for new installations.</b></p>
[<a href="../index.php">Home</a>]
</b></p>
<div align="center">
<center>
<table border="0" cellspacing="0" width="95%" cellpadding="0">
<tr>
<td width="50%">
<b>File Name</b></td>
<td width="15%">
<b>File Size</b></td>
<td width="35%">
<b>Date</b></td>
</tr>
<tr>
<td width="100%" colspan="3">
<hr noshade color="#000000" size="1"></td>
</tr>
<?php


$gen = date("M d Y h:i:s A");
clearstatcache();
$total = 0;
if ($handle = opendir('.')) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "index.php" && filetype($file)!="dir") {
			
			$total = $size + $total;
			$size = filesize($file);
			$size = round($size / 1024, 2);
			$date = date("M d Y h:i:s A", filemtime($file));
			echo "<tr>";
			echo "<td width=\"1%\">";
			echo "<a href =\"$file\">$file</a></td>";
			echo "<td width=\"1%\">";
			echo "$size KB</td>";
			echo "<td width=\"1%\">";
			echo "$date</td>";
			echo "</tr>";
		}
	}
	closedir($handle);
}
?>
<tr>
<td width="100%" colspan="3">
<hr noshade color="#000000" size="1"></td>
</tr>
<tr>
<td width="1%">
<br><b><p align="center">Total Size:&nbsp;</p></b></td>
<td width="1%">
<br><b><p align="left"><?php echo $total; ?> KB</p></b></td>
<td width="1%">
</td>
</tr>
</table>
</center>
</div>
<br><p align="center">Page generated on <b><?php echo $gen; ?></b></p>
</body>
</html>
