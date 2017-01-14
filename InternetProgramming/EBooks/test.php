<?php
	include("/php/dbinfo.inc.php");
		mysql_connect('localhost',$username,$password);
		@mysql_select_db("ebooks") or die( "Unable to select database");
		$query1 = "SELECT * FROM `all_books` WHERE 1 LIMIT 51, 50";
		$result = mysql_query($query1);
		$num = mysql_numrows($result);
		echo '<b>MySQL Statement: ', $query1, '<br/>';
		echo 'Results of Query Statement: ', $result, '<br/>';
		echo 'Number of rows equals: ', $num, '</b><br/>';
?>
		<table class="" cellpadding="5" border="1">
			<center><h2>List of all books sorted by Author's Last Name</b></h2></center>
			<tr class="coltitle">
				<th><center><?php $n = "Title"; printf("%-s", $n);  ?></center></th>
				<th><center><?php $n = "Author"; printf("%-s", $n);  ?></center></th>
				<th><center><?php $n = "ISBN"; printf("%-s", $n);  ?></center></th>
				<th><center><?php $n = "URL"; printf("%-s", $n);  ?></center></th>
			</tr>

<?php
		$i = 0;
		while ($i < $num )
		{

		$title = mysql_result($result,$i,"Title");
		$author = mysql_result($result,$i,"Author");
		$isbn = mysql_result($result,$i,"ISBN");
		$url = mysql_result($result,$i,"URL");
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
	echo "</table>";
?>