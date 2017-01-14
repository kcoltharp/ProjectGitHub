<?php

     function tvalue ( &$value )
     {
          $value = trim ( $value, " ' " );
     }

     function displayID ()
     {
          $username = "kenny";
          $password = "kc2269";
          $database = "kennys_db";		  

          mysql_connect ( 'localhost', $username, $password );
          @mysql_select_db ( $database ) or die ( "Unable to select database" );

		  $query  = "SELECT id FROM to_do";
		  $result = mysql_query($query);

		  while( $row = mysql_fetch_assoc( $result ) )
		  {			
			foreach ( $row as &$value )
			{
				echo ( int )$value + 1;
			}
		  }
		  
		  /* for ( $i = 0; $i <= sizeof( $row ); i++ )
          $sql = "SELECT id FROM to_do";
          echo "<br />SQL=".$sql."<br />";
          
          $result = mysql_query ( $sql );
          echo "<br />RESULT=".$result."<br />";
          
          $row = mysql_fetch_row ( $result );
		  echo "<br />ROW=".var_dump($row)."<br />";
          $type = $row[ 1 ];
		  echo "<br />TYPE=".$type."<br />";
          preg_match ( '/enum\((.*)\)$/', $type, $matches );
          $vals = explode ( ',', $matches[ 0 ] );
          array_walk ( $vals, 'tvalue' );
          
          foreach ( $vals as $value )
          {
               echo "<option value='$value'>$value</option>";
          }*/
     }

	 displayID();
?>