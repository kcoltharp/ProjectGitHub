<?php
include("/php/dbinfo.inc.php");
if( mysql_connect('localhost',$username,$password) )
{
	echo '<center><b>Connected!</b></center>';
}
@mysql_select_db("ebooks") or die( "Unable to select database");
$start_number = 0;
$items_per_page = 100;
$table = 'all_books';


if($start_number >= 0)
{
	//count the items in the category
	$sql = "SELECT count(*) AS count FROM '$table'";
	$result = @mysql_query($sql);
	echo '<br />';
	echo $result = @mysql_query($sql);
	echo '<br />';
	echo $sql;
	echo '<br />This is query and result of query in create_navbar: <br />';
	echo $result;
	echo '<br />';
	while($row = mysql_fetch_array($result))
	{
		$count = $row['count'];
	}//end while loop
	
	//now get the results to show to the users
	$sql = "SELECT * FROM '$table' LIMIT '$start_number', '$items_per_page'";
	$result1 = mysql_query($sql);
	echo '<br />';
	echo $sql;
	echo '<br />This is 2nd query and result of query in create_navbar: <br />';
	echo $result1;
	echo '<br />';
	if(mysql_numrows($result1) > 0)
	{
		$i = 0;
		while($row = mysql_fetch_array($reuslt))
		{
			//if( $i <= $items_per_page)
			$title=mysql_result($result,$i,"Title");
			$author=mysql_result($result,$i,"Author");
			$isbn=mysql_result($result,$i,"ISBN");
			$url=mysql_result($result,$i,"URL");
		?>
			<tr>
			<td><?php echo "$author"; ?></td>
			<td><?php echo "$title"; ?></td>
			<td><?php echo "$isbn"; ?></td>
			<td><?php echo "<a href='$url'>Download</a>";?></td>
			</tr>
		<?php
			++$i;
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