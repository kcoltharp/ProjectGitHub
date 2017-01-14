<?php

$start_number = intval($_GET["start"]);
$items_per_page = 100;
$where_clause = 1;
$table = 'all_books';


if($start_number >= 0)
{
	//count the items in the category
	$sql = "SELECT count(*) AS count FROM '$table' WHERE '$where_clause'";
	$result = @mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		$count = $row['count'];
	}//end while loop
	
	//now get the results to show to the users
	$sql = "SELECT product_id, product_name FROM '$table' WHERE '$where_clause' LIMIT $start_number $items_per_page";
	$result = mysql_query($sql);
	if(mysql_num_rows($results) > 0)
	{
		while($row = mysql_fetch_array($reuslt))
		{
			//loop through and add HTML 
			//into $$where_clause
			$where_clause .= "Datafrom SQL Query";
		}//end while loop		
	}
	else
	{
		$where_clause = "There were no items found!";
	}
	
	$navbar = create_navbar($start_number, $items_per_page, $count);
}//end if stmt

if(is_null($where_clause))
{
	echo 'Invalid Input!';
}
else
{
	echo "$navbar<br />$where_clause";
}

?>