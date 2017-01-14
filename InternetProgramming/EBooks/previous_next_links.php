<?php

function create_navbar( $start_number = 0, $items_per_page = 50, $count )
{
	//creates a navigation bar
	$current_page = $_SERVER['PHP_SELF'];
	
	if( ( $start_number < 0 ) || ( !is_numeric( $start_number ) ) )
	{
		$start_number = 0;
	}
	
	$navbar = "";
	$pre_navbar = "";
	$next_navbar = "";
	
	if ( $count > $items_per_page )
	{
		$nav_count = 0;
		$page_count = 1;
		$nav_passed = false;
		
		while( $nav_count < $count )
		{
			//Are we at the current page position
			if ( ( $start_number <= $nav_count ) && ( $nav_passed != true ) )
			{
				$nav_bar = "<b><a href=\"$current_page?start=$nav_count\">[$page_count]</a></b>";
				$nav_bar .= "<b><a href=\"$current_page?start=$nav_count\">[$page_count]</a></b>";
				$nav_passed = true;
				//Do we need a "prev" button?
				if( $start_number != 0 )
				{
					$prevnumber = $nav_count - $items_per_page;
					if( $prevnumber < 1)
					{
						$prevnumber = 0;
					}//end inner if stmt
					$prev_navbar = "<a href=\"$current_page?start=$prevnumber\">&lt;&lt;Prev - </a>";
				}//end middle if stmt
				
				$next_number = $items_per_page + $nav_count;
				
				//Do we need a "next" button?
				if( $next_number < $count )
				{
					$next_navbar ="<a href=\"$current_page?start=$next_number\"> - Next&gt;&gt;</a><br />";
				}
				else
				{
					//Print Normally
					$navbar .= "<a href=\"$current_page?start=$nav_count\">[$page_count]</a>";
				}//end if/else block stmt
				
				$nav_count += $items_per_page;
				$page_count++;
			}// end outer if stmt						
		}//end while loop
		$navbar = $prev_navbar . $navbar . $next_navbar;
		return $navbar;
	}//end outer most if stmt
}//end function create_navbar

//create_navbar( $start_number = 0, $items_per_page = 50, $count );

?>