<?php
header('Content-type: text/html; charset=utf-8');

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
include ('auth/include/session.inc.php');
if (!$session->logged_in && !$allowGuestAccess) {
	header('Location: login.php');
	die();
}
// config.inc.php should be included by now
$dbNew = new DB($dbhost, $dbuser, $dbpass, $dbname);
$timeManager = new TimeManager($session);

/* Included languages */
include ('lang/lang.inc.php');

/* Make sure we have a current time */
if (isset ($_SESSION['current'])) {
	//FIXME we don't need this extra variable
	$current = $_SESSION['current'];
} else {
	$_SESSION['current'] = time();
}
/*
 * Rest of the includes
 */
include ('includes/functions.inc.php');
include ('includes/monthtable.inc.php');
include ('adodb/adodb.inc.php');
$db = ADONewConnection('mysql');
$db->Connect($dbhost, $dbuser, $dbpass, $dbname);
$db->debug = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title><?php echo $lang["title"];?></title>
  <link href="style.css.php" rel="stylesheet" type="text/css"/>
  <link href="CalendarControl.css" rel="stylesheet" type="text/css"/>
  <link href="TimeControl.css" rel="stylesheet" type="text/css"/>
  <link rel="shortcut icon" href="favicon.ico" />
  
</head>
<body>
<script src="CalendarControl.js.php" type="text/javascript"></script>
<script src="TimeControl.js.php" type="text/javascript"></script>
<?php


/*
 * ============================================================================
 * Busines logic
 */

//events

if (isset ($_GET["deleteEvent"]) && $session->logged_in) {
	$deleteid = mysql_real_escape_string($_GET["deleteEvent"]);
	if ($singleAgenda)
		$db->Execute("update " .
		$dbprefix . "events set status=1 where id=$deleteid");
	else
		$db->Execute("update " .
		$dbprefix . "events set status=1 where id=$deleteid and user_id=" . $session->id);
	unset ($_GET["deleteEvent"]);
}
if (isset ($_GET["deleteTODO"]) && $session->logged_in) {
	$deleteid = mysql_real_escape_string($_GET["deleteTODO"]);
	if ($singleAgenda)
		$db->Execute("update " .
		$dbprefix . "todo set status=1 where id=$deleteid");
	else
		$db->Execute("update " .
		$dbprefix . "todo set status=1 where id=$deleteid and user_id=" . $session->id);
	unset ($_GET["deleteTODO"]);
}
if (isset ($_GET["finishTODO"]) && $session->logged_in) {
	$finishid = mysql_real_escape_string($_GET["finishTODO"]);
	$time = time();
	if ($singleAgenda)
		$db->Execute("update " .
		$dbprefix . "todo set status=2, closed=$time where id=$finishid");
	else
		$db->Execute("update " .
		$dbprefix . "todo set status=2, closed=$time where id=$finishid and user_id=" . $session->id);
	unset ($_GET["finishTODO"]);
}
if (isset ($_GET["finishEVENT"]) && $session->logged_in) {
	$finishid = mysql_real_escape_string($_GET["finishEVENT"]);
	$time = time();
	if ($singleAgenda)
		$db->Execute("update " .
		$dbprefix . "events set status=2 where id=$finishid");
	else
		$db->Execute("update " .
		$dbprefix . "events set status=2 where id=$finishid and user_id=" . $session->id);
	unset ($_GET["finishEVENT"]);
}
if (isset ($_GET["newprior"]) && $session->logged_in) {

	$newprior = mysql_real_escape_string($_GET["newprior"]);
	if ($newprior >= 0 and $newprior <= 5) {
		$tmp_id = mysql_real_escape_string($_GET["eventid"]);
		if ($singleAgenda)
			$db->Execute("update " .
			$dbprefix . "todo set priority=$newprior where id=$tmp_id and user_id=" . $session->id);
		else
			$db->Execute("update " .
			$dbprefix . "todo set priority=$newprior where id=$tmp_id");
	}
	unset ($_GET["newprior"]);
}

/*
 * ============================================================================
 */
?>

<!-- header div -->
<div id="hdr">
<div style="padding-left:10px;text-align: left;float: left;">
<?php


echo '<a href="engine/changedate.php?timestamp=' . time() . '">' . $timeManager->ymd(time()) . ', ' . $timeManager->hm(time()) . '</a>, ';

if ($session->logged_in) {
	echo $lang['loggedin'] . ': <a href="auth/useredit.php">' . $session->username . '</a>';
	echo ' (' . $timeManager->getDataTimeZone()->getName() . ') ';
} else {
	echo '[<a href="login.php">' . $lang['login'] . '</a>]';
}
if ($enableProjectTracking) {
	echo '[<a href="projectmanagement.php">Project management</a>]';
}
if ($session->isAdmin()) {
	echo ' [<a href="auth/admin/admin.php">Admin Center</a>]';
}

if ($session->logged_in) {
	echo ' [<a href="auth/process.php">' . $lang['logout'] . '</a>]';
}
?>
</div>
</div>
<!-- center column -->
<div id="c-block">
<div id="c-col">
<?php


if (isset ($_GET["page"])) {
	switch ($_GET["page"]) {
		case "navlinks" :
			include ('pages/navlinks.inc.php');
			break;
		case "overview" :
			include ('pages/overview.inc.php');
			break;
		case "todo" :
			include ('pages/todo.inc.php');
			break;
		default :
			include ('pages/normal.inc.php');
	}

} else {
	include ('pages/normal.inc.php');
}
if ($session->logged_in) {
	include ('includes/addevent.inc.php');
}
?>
<div class="box">
<h4><?php echo $lang['index-addtodo'];?></h4>
<form action="engine.php" method="post" >
<input type="hidden" name="action" value="addTODO" />
	<label for="priority"><?php echo $lang['todo-priority'];?></label>
	<select id="priority" name="priority" size="1">
		<option value="4"><?php echo $lang['todo-today'];?></option>
		<option value="5"><?php echo $lang['todo-urgent'];?></option>
		<option value="3"><?php echo $lang['todo-week'];?></option>
		<option value="2"><?php echo $lang['todo-month'];?></option>
		<option value="1"><?php echo $lang['todo-year'];?></option>
		<option value="0"><?php echo $lang['todo-sometime'];?></option>
	</select><br/>
	<?php
echo '<label for="project">Project:</label>';
echo '<select id="project" name="project" size="1">';
printTree(-1, 0);


function printTree($parent, $depth) {
	global $singleAgenda;
	global $dbNew;
	global $dbprefix;
	/* Currently no support for nested projects */
	if($parent <>-1)
		return;
	$sql = "select * from " . $dbprefix . "projects where parent=$parent";
	if (!$singleAgenda) {
		$sql .= " and user_id=$session->id";
	}
	$arr = $dbNew->queryAsArray($sql);
	if (count($arr) > 0) {
		foreach ($arr as $row) {
			echo '<option value="'.$row['id'].'">'.dash($depth). h($row['name']).'</option>';
			printTree($row['id'], $depth +1);
		}
	}
}
function dash($count){
	
     $output= '';
     
     for($i=0;$i<$count; $i++){
        $output .= '- ';
     }
     
    return $output;

}
echo '	</select><br/>';
?>
	
	
	<label for="text"><?php echo $lang['todo-description'];?></label>
	<input id ="text" type="text" name="text" size="50" />
	<input type="submit" value="<?php echo $lang['todo-button'];?>" name="newTODO"/>
</form>
</div>
<!-- ===================== NEXT EVENTS BOX ========================= -->
<div class="box">
<h4><?php echo $lang['nextevents'];?></h4>
<?php


$start = $timeManager->getStart(time());
if ($session->logged_in && !$singleAgenda) {
	$sql = "select distinct * from " . $dbprefix . "events where status!=1 and date>=" . $start . " and user_id=" . $session->id . " order by date asc limit 20";
} else {
	$sql = "select distinct * from " . $dbprefix . "events where status!=1 and date>=" . $start . " order by date asc limit 20";
}
$recordXSet = $db->Execute($sql);
echo '<table width="100%">';
echo '<tr><td></td><td></td></tr>'; //for xhtml strict if there are no events
while (!$recordXSet->EOF) {
	$nextid = $recordXSet->fields["id"];

	$dtime = $timeManager->getLocalDateTime($recordXSet->fields["date"]);
	echo '<tr>';
	if ($recordXSet->fields["dayevent"] == 0)
		echo '<td width="25%" align="left"><a href="engine/changedate.php?date=' . $dtime->format("Y-m-d") . '">' . $dtime->format("j-m-y  H:i") . '</a></td>';
	else
		echo '<td width="25%" align="left"><a href="engine/changedate.php?date=' . $dtime->format("Y-m-d") . '">' . $dtime->format("j-m-y") . '</a></td>';
	echo '<td align="left"><span title="' . $recordXSet->fields["description"] . '">' . $recordXSet->fields["title"] . "</span></td>";
	echo "<td width=\"5%\" align=\"right\"><a href=\"?deleteEvent=$nextid\" onClick=\"javascript:return confirm('" . $lang['certainremove'] . "')\"><img src=\"img/delete.png\"/ alt=\"delete\"/></a></td>";
	echo '</tr>';

	$recordXSet->MoveNext();
}
echo '</table>';
?>
</div>
</div>
<!-- end of center column -->
</div>
<!-- end c-block -->
<!-- ===================== FOOTER ========================= -->
<div id="ftr">
	<?php include('includes/footer.php');?>
</div>
<!-- ====================== LEFT ========================== -->
<!-- left column -->
<div id="lh-col">
<div class="box">
<form action="engine/changedate.php" method="post" >
	<label for="date"><?php echo $lang["date"];?> (yyyy-mm-dd):</label>
	<input size="12" name="date" id="date" onfocus="showCalendarControl(this);" type="text"/>
	<input type="submit" value="<?php echo $lang["index-goto"];?>" name="goto"/>
</form>
</div>

<div class="box">
<!-- coming days -->
<table width="100%">
<?php


echo '<tr><td colspan="7" align="center"><b>' . $lang['left-coming'] . '</b></td></tr>';
echo '<tr>';
for ($i = 0; $i < 7; $i++) {
	$xcolor = '#ffffff';
	$start = $timeManager->getStart(time(), $i);
	$end = $timeManager->getEnd(time(), $i);
	if ($session->logged_in && !$singleAgenda) {
		$sql = "select * from " . $dbprefix . "events where status!=1 and date>=$start and date<$end and user_id=" . $session->id . " order by date asc";
	} else {
		$sql = "select * from " . $dbprefix . "events where status!=1 and date>=$start and date<$end order by date asc";
	}
	$recordSet = & $db->Execute($sql);
	$count = 0;
	while (!$recordSet->EOF) {
		$count++;
		$recordSet->MoveNext();

	}
	if ($count > 0) {
		$xcolor = '#ff0000';
	}
	if ($timeManager->w($start) == 0 or $timeManager->w($start) == 6)
		echo '<td><span style="background: ' . $xcolor . ' ;"><b><a href="engine/changedate.php?timestamp=' . $start . '">' . $timeManager->j($start) . "</a></b></span></td>";
	else
		echo '<td><span style="background: ' . $xcolor . ' ;"><a href="engine/changedate.php?timestamp=' . $start . '">' . $timeManager->j($start) . "</a></span></td>";
}
echo '</tr>';
?>
</table>
</div>
<div class="box">
<?php


printmonthtable(0, $db);
?>
</div>
<div class="box">
<?php


printmonthtable(1, $db);
?>
</div>
<div class="box">
<?php


printmonthtable(2, $db);
?>
</div>
</div>
<!-- end of left column -->
<!-- ======================= RIGHT ================================ -->
<!-- right column -->
<div id="rh-col">
<!-- === DEADLINES === -->
<?php

include ("includes/deadlinebox.inc.php");

?>
<!-- === TODO LIST === -->
<?php
printTODOlist($db, true, $numberOfTODO);
?>


<div class="total-box">
	<div class="title">
		<strong><?php echo $lang['right-recently'];?></strong>
	</div>
	<div class="main">
	

<?php


if ($session->logged_in && !$singleAgenda) {
	$sql = "select * from " . $dbprefix . "todo where status=2 and user_id=" . $session->id . " order by closed desc limit 10";
} else {
	$sql = "select * from " . $dbprefix . "todo where status=2 order by closed desc limit 10";
}
$recordSet = & $db->Execute($sql);
$count = 0;
if (!$recordSet->EOF)
	echo "<ul>";
while (!$recordSet->EOF) {
	$count++;
	echo '<div class="todo">';
	$recentid = $recordSet->fields["id"];
	$priority = $recordSet->fields["priority"];
	echo "<div width: 100%>";
	echo "<li>" . $recordSet->fields["text"] . "</li>";
	echo "</div>";
	echo '</div>';
	$recordSet->MoveNext();
}
if ($count > 0)
	echo '</ul>';
?>

</div>
</div>
</div>
<!-- end of right column -->
</body>
</html>
<?php


$db->Close();
?>

