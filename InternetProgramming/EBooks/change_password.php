<?php

$form = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"><br/>
<html><br/>
	<head><br/>
		<title>Change Login Password</title><br/>
	</head><br/>
	<body><br/>
		<form method=\"POST\" action=\"\">
			<br /><p><b>Username: </b></p>
			<input type=\"text\" name=\"username\" size=\"25\" maxlength=\"25\"/><br />
			<p><b>Password: </b></p><br />
			<input type=\"password\" name=\"password\" size=\"25\" maxlength=\"25\"/><br />
			<p><b>Enter New Password: </b></p><br />
			<input type=\"password\" name=\"newpassword\" size=\"25\" maxlength=\"25\"/><br />
			<p><b>Enter New Password Again: </b></p><br />
			<input type=\"password\" name=\"newpassword2\" size=\"25\" maxlength=\"25\"/><br />
			<p><input type=\"submit\" name=\"Submit\" value=\"Login\"/></p>
		</form><br/>
	</body><br/>
</html>";
if ( @$_POST[ 'Submit' ] )
{
    if ( ( ! isset ( $_POST[ 'username' ] ) ) || ( ! isset ( $_POST[ 'password' ] ) ) )
    {
        header ( "Location: change_password.php" );
        exit;
    }

    if ( ( isset ( $_POST[ 'password' ] ) ) && ( isset ( $_POST[ 'newpassword2' ] ) ) )
    {
        if ( ($_POST[ 'newpassword' ] == $_POST[ 'newpassword2' ] ) )
        {
            $db_name = "ebooks";
            $table_name = "users";
            $username = htmlentities ( trim ( strtolower ( $_POST[ 'username' ] ) ) );
            $pwd = htmlentities ( trim ( strtolower ( $_POST[ 'newpassword' ] ) ) );
            $pwd = md5 ( $pwd );

            include("pages/dbinfo.inc.php");
            $connect = mysql_connect ( 'localhost', $username, $password ) or die ( mysql_error () );
            $db = mysql_select_db ( $db_name, $connect ) or die ( mysql_error () );

            $sql = "UPDATE '$table_name' SET 'pwd' = '$pwd' WHERE 'users'.'user_name' = '$username'";
            //$sql = "SELECT * FROM $table_name WHERE user_name = '$_POST[username]' AND pwd = '$pwd'";
            echo $sql, '<br />';
            $result = @mysql_query ( $sql ) or die ( mysql_error () );
            //$num = mysql_affected_rows( $result );

            if ( $result )
            {
                echo '<br /><p><b><center>Your password has been updated in the database.<br /></p></b></center>';
                echo '<a href="show_login.php">Login</a>';
            }
            else
            {
                echo '<br /><p><b><center>Your password was NOT updated in the database!<br />', mysql_error (), '</p></b></center>';
                echo $form;
            }
        }
        else
        {
            echo "<br /><p><b><center>Passwords do not match. Try again.</p></b></center><br />";
            echo '<a href="show_login.php">Login</a><br />';
            echo '<a href="change_password.php">Change Password</a><br />';
        }
    }
    else
    {
        header ( "location: change_password.php" );
        exit;
    }
}
else
{
    echo $form;
}
?>