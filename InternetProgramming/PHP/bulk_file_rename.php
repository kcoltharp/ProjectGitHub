<?php
$dir = "C:/wamp/www/PHP/todo/ladder_class/appt_calendar";
$fileType = "php";
$charsToTrim = 0;
if($handle = opendir($dir))
{
    $count = 1;
    while (false !== ($file = readdir($handle))) // read files in directory one by one
   {
    if(is_file($dir."/".$file))
    {
        $extension = substr(strrchr($file,"."),1);// get the extension
        if(strcasecmp($fileType,$extension) == 0)// proceed only if it matches with the extension we have provided
        {
            $newName = substr($file,$charsToTrim); // generate new name for file
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
            }
        }
    }
   }
    echo $count." files renamed";
}
    closedir($handle);
?>