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
<div class="total-box">
	<div class="title">
		<strong><?php echo $lang['right-deadline'];?></strong>
	</div>
	<div class="main">
<?php


if ($session->logged_in && !$singleAgenda) {
	$sql = "select * from " . $dbprefix . "events where status=0 and deadline=1 and user_id=" . $session->id . " order by date asc limit 10 ";
} else {
	$sql = "select * from " . $dbprefix . "events where status=0 and deadline=1 order by date asc limit 10 ";
}
$recordSet = & $db->Execute($sql);

while (!$recordSet->EOF) {

	$deadid = $recordSet->fields["id"];
	$arr = $dbNew->queryAsArray("select * from " . $dbprefix . "event_target where event_id=$deadid and user_id=" . $session->id);
	$targetInsert = "";
	if ($enableEventTargetting && sizeof($arr) == 1) {
		$targetInsert = 'background-color:#ffc;';
	}else{
		$targetInsert = 'background-color:#cff;';
	}
	$dtime = $timeManager->getLocalDateTime($recordSet->fields['date']);
	
	$diff=$dtime->format('U') - time();
	if($diff<0)
		$targetInsert= 'background-color: red;';
		
	$days = (int)($diff  / (60 * 60 * 24));
	$hours = (int) ($diff / (60 * 60))-($days*24);
	$minutes = (int) ($diff / 60)-($days*24*60)-($hours*60);
	
	echo '<div style="margin: 0.1em;'.$targetInsert.'">'."<a onClick=\"javascript:return confirm('" . $lang['certainfinish'] . "')\" href=\"?finishEVENT=$deadid\"><img height='100%' src=\"img/finished.png\" alt=\"finish\" /></a>";
	if (isURL($recordSet->fields["description"])) {
		echo ' <a href="' . h($recordSet->fields["description"]) . '" title="' . $recordSet->fields["description"] . '">' . $recordSet->fields["title"] . '</a>';
	} else {
		echo ' <span title="' . $recordSet->fields["description"] . '">' . $recordSet->fields["title"] . '</span>';
	}
	
	echo '<br/><span style="font-size:small">&nbsp;&nbsp;&nbsp;&nbsp;<b><a href="engine/changedate.php?date=' . $dtime->format("Y-m-d") . '">' . $dtime->format("j-m-y") . '('.($diff>0?'':'-'). abs($days) . 'd '.abs($hours).':'.abs($minutes).')</a></b></span>';
	echo '</div>';

	$recordSet->MoveNext();
}
?>
	</div>
</div>


