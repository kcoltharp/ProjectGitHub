<?php

require_once 'app/init.php';

if(isset($_GET['as'] , $_GET['item']))
{
	$as = $_GET['as'];
	$item = $_GET['item'];
	
	switch($as)
	{
		case 'done':
			$doneQuery = $db->prepare("UPDATE items SET done = 1 WHERE id = :item");
			
			$doneQuery->execute([
			    'item' => $item
			]);
			break;
		
		case 'delete':
			$deleteQuery = $db->prepare("DELETE FROM items WHERE id = :item");
			
			$deleteQuery->execute([
			    'item' => $item
			]);
		
	}
	//echo '<META http-equiv="refresh" content="1;URL=http://kennys-spot.org/index.php">';
	echo '<META http-equiv="refresh" content="1;URL=http://localhost/Grocery_ToDo_List/">';
}
else
{
	//echo '<META http-equiv="refresh" content="1;URL=http://kennys-spot.org/index.php">';
	echo '<META http-equiv="refresh" content="1;URL=http://localhost/Grocery_ToDo_List/">';
}
?>
