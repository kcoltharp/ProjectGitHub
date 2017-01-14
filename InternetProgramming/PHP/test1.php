<?php
	function trim_value(&$value) 
	{ 
		$value = trim($value, " ' "); 
	}

	function displayCategory()
	{
		$username="kenny";
		$password="kc2269";
		$database="kennys_db";

		mysql_connect( 'localhost', $username, $password );
		@mysql_select_db( $database ) or die( "Unable to select database" );
		
		$sql = "SHOW COLUMNS FROM to_do LIKE 'category' ";
		echo "<br />".$sql."<br />";
		
		$result = mysql_query($sql);
		echo "<br />Result<br />".$result."<br />";
		
		$row = mysql_fetch_row($result);
		echo "<br />Row<br />".$row."<br />";
		
		$type = $row[ 1 ];
		preg_match('/enum\((.*)\)$/', $type, $matches);
		echo "<br />Matches Array<br />";
		var_dump($matches);
		$vals = explode(',', $matches[1]);
		array_walk( $vals, 'trim_value');
		echo "<br />Vals Array<br />";
		var_dump($vals);
		
		return $vals;
		
	}
	displayCategory();
	?>