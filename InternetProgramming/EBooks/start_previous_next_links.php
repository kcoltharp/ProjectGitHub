<?php

function AuthorLastName()
{
	include("/php/dbinfo.inc.php");
	mysql_connect('localhost',$username,$password);
	@mysql_select_db("ebooks") or die( "Unable to select database");
	include('previous_next_links.php');
	
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
               $i=0;
               while ($i < $num )
               {
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
                  }
                  echo "</table>";
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
}

function Title()
{
	include("/php/dbinfo.inc.php");
	mysql_connect('localhost',$username,$password);
	@mysql_select_db("ebooks") or die( "Unable to select database");
	include('previous_next_links.php');
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
		$sql = "SELECT `Author`, `Title`, `ISBN`, `URL` FROM `all_books` ORDER BY `all_books`.`Title` ASC LIMIT $start_number $items_per_page ";
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
}

function ISBN()
{
	include("/php/dbinfo.inc.php");
	mysql_connect('localhost',$username,$password);
	@mysql_select_db("ebooks") or die( "Unable to select database");
	include('previous_next_links.php');
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
}
AuthorLastName();
?>