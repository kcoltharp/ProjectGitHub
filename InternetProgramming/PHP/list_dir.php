<?php

function getDirContents($dirToRead)
{
	$filename = "C:/wamp/www/dir2.txt";
	$file = fopen("C:/wamp/www/dir2.txt", 'w');
	$dir = $dirToRead;
	$dh = opendir($dir);
	
	$dir2 = scandir($dir);
	$dir3 = array_slice($dir2, 2);
	//if ( is_dir($filename) !== '.' && is_dir($filename) !== '..')
//	{
		//echo $filename . ' is being copied to the array.<br />';
		////move fwrite to here!!!!
			if (is_writable($filename))
			{
				if (!$handle = fopen($filename, 'a+'))
				{
					echo "Cannot open file $file";
					exit;
				}
				//for (i = 0; $i < sizeof($dir2); i++)
				foreach ($dir3 as &$value)
				{
					//$strData = fwrite($handle, $value . '\n');
					fwrite($handle, $value."\n");
					echo "Success, wrote " . $value . " to " . $file . "<br />";
				}
				
				fclose($handle);
			}
			else
			{
				echo "Error writing to " . $file;
			}
//	}
	//else
	//{
		//echo $filename . ' is either a file or a directory not copied to the array.<br />';
	//}
}
	
getDirContents("C:/wamp/www");
?>