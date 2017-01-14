<?php

echo $_POST[ 'username' ], '<br />';
echo $_POST[ 'password' ], '<br />';

if ( ( ! isset ( $_POST[ 'username' ] ) ) || ( ! isset ( $_POST[ 'password' ] ) ) )
{
    header ( "Location: show_login.php" );
    exit;
}

if ( isset ( $_POST[ 'username' ] ) )
{

    $db_name = "ebooks";
    $table_name = "users";
    $pwd = htmlentities( strtolower( trim( $_POST[ 'password' ] ) ) );
    $pwd = md5 ( $pwd );

    include("php/dbinfo.inc.php");
    $connect = mysql_connect ( 'localhost', $username, $password ) or die ( mysql_error () );
    $db = mysql_select_db ( $db_name, $connect ) or die ( mysql_error () );
    $user = htmlentities( strtolower( trim( $_POST[ 'username' ] ) ) );
	$sql = "SELECT * FROM $table_name WHERE user_name = '$user' AND pwd = '$pwd'";
    $result = @mysql_query ( $sql ) or die ( mysql_error () );
    $num = mysql_num_rows ( $result );

    if ( $num > 0 )
    {
        header ( "Location: main.php" );
        exit;
    }
    else
    {
        echo $user, ' , ', $pwd, ', ', header ( "Location: unauthorized_login.php" );
        exit;
    }
}
else
{
    header ( "Location: show_login.php" );
    exit;
}
?>