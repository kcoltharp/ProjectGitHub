<?php
	
	$dir = "C:/wamp/www/PHP/todo/ladder_class/security";
	$old_ext = "cls";
	$new_ext = "php";
	
	if($handle = opendir($dir))
	{
		$count = 1;
		while (false !== ($file = readdir($handle))) // read files in directory one by one
	   {
			if(is_file($dir."/".$file))
			{
				$extension = substr(strrchr($file,"."),1);// get the extension
				echo "<br />" . $extension . "<br />";
				if ($extension === $old_ext)
				{
					$pieces = explode( "." , $file);
					unset( $pieces[ 1 ] );
					$pieces[ 1 ] = $new_ext;
					$newName = implode ( ".", $pieces );
					$success = rename($dir."/".$file, $dir."/".$newName); // rename the file
					 if($success)
					{
						echo $file." renamed to ".$newName;
						echo "<br>";
						$count++;
					}
					else
					{
						echo "Cannot rename ".$file. " to ".$newName."<br>";
						echo "<br>";
					}//end if/else					
				}//end if 
				else
				{
					echo "<br />" . $extension . " does not match " . $old_ext . "<br />";
				}
			}//end if
	   }//end while loop
	}//end outer if loop
	
?>