<?php

include("/php/dbinfo.inc.php");
if( mysql_connect('localhost',$username,$password))
{
	@mysql_select_db("ebooks") or die( "Unable to select database");
	echo '<h3>Connected</h3><br />';
}
else
{
	echo '<br />' . mysql_error() . '<br />';
}

if(isset($_GET['start']))
{
	$start = $_GET['start'];
	echo $start, "<br />";
}
else //if(!isset($start))
{
	$start = 0;
}
	$items_per_page = 50;
	$query = "SELECT count(*) as count FROM `all_books` WHERE 1"; 
	echo $query, "<br />";
	$result = mysql_query($query);
	echo $result, "<br />";
	$row = mysql_fetch_array($result);
	var_dump($row);
	$numrows = $row['count'];
	echo "<br />", $numrows, "<br />";

	$query1 = "SELECT * FROM `all_books` LIMIT " . $start . "," . $items_per_page;
	echo $query1, "<br />";
	$result1 = mysql_query($query1);
	echo $result1, "<br />";
	$num = mysql_numrows($result1);
	?>
	<div>
		<table class="" cellpadding="5" border="1">

			<center><h2>List of all books sorted by Author's Last Name</b></h2></center>

		<tr class="coltitle">
			 <th><center><?php $n = "Title"; printf("%-s", $n);  ?></center></th>
			 <th><center><?php $n = "Author"; printf("%-s", $n);  ?></center></th>
			 <th><center><?php $n = "ISBN"; printf("%-s", $n);  ?></center></th>
			 <th><center><?php $n = "URL"; printf("%-s", $n);  ?></center></th>
		</tr>

		<?php
			$i=0;
			while ($i < $num )
			{
			$title=mysql_result($result1,$i,"Title");
			$author=mysql_result($result1,$i,"Author");
			$isbn=mysql_result($result1,$i,"ISBN");
			$url=mysql_result($result1,$i,"URL");
			?>
			<tr>
				 <td><?php echo "$author"; ?></td>
				 <td><?php echo "$title"; ?></td>
				 <td><?php echo "$isbn"; ?></td>
				 <td><?php echo "<a href='$url'>Download</a>";?></td>
			</tr>
		<?php
			++$i;
			}
			echo "</table><br /></div>";

	//this code was wrong, I did not have the second query. Thanks to Plaggy Pig.
	// need another query to get the total amount of rows in our table
	
if($start > 0)
{
	$self = $_SERVER['PHP_SELF'];
	echo "<a href='{$_SERVER['PHP_SELF']} ?start=($start - $items_per_page)'>Previous</a><br />";
}
if($numrows > ($start + $items_per_page))
{
	$self = $_SERVER['PHP_SELF'];
	echo "<a href='{$_SERVER['PHP_SELF']} ?start=($start + $items_per_page)'>Next</a><br />";
}
		
//Read more at http://www.codewalkers.com/c/a/Database-Articles/PHP-Previous-and-Next-Links/4/#frb4hcrgDpX8pKmr.99
?>