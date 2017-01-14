<?php

require_once 'app/init.php';

if(isset($_POST['name']))
{
	$name = trim($_POST['name']);
	
	if(!empty($name))
	{
		$addedQuery = $db->prepare("
			   INSERT INTO items (name, user, done, created) 
			   VALUES (:name, :user, 0, NOW())
			   ");
		
		$addedQuery->execute([
		    'name' => $name,
		    'user'  => $_SESSION['user_id']
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