	<?php
	/*
		$source = "G:/EBOOKS - KINDLE - 24100 BOOKS";
		$handle = scandir($source);
		$target = "C:/Users/Kenny/Documents/EBooks/";
		$x = 0;
		
		foreach($handle as $value)
		{
			$x++;
			copy($source . "/" . $value, $target . $value);
			echo $x . "  ". $source . "/" , $value . " has been copied to " . $target . "<br />";
		}
		*/
	
	$src = "G:/";
	$dst = "C:/Users/Kenny/Documents/EBooks/";
		
	function recurse_copy($src,$dst) 
	{ 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) 
	{ 
        if (( $file != '.' ) && ( $file != '..' )) 
		{ 
            if ( is_dir($src . '/' . $file) ) 
			{ 
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
				echo 'Copying: ' . $src . '/' . $file . ' to ' . $dst . '/' . $file . '<br />';
            } 
            else 
			{ 
                copy($src . '/' . $file,$dst . '/' . $file);
				echo 'Copying: ' . $src . '/' . $file . ' to ' . $dst . '/' . $file . '<br />';
            }//end if/else 
        }//end out if 
    }//end while loop 
    closedir($dir);
	}//end function 
	recurse_copy($src, $dst);
	?>