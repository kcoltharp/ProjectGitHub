<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/Grocery_ToDo_List/';
//require_once  $root . '/login.php';

$dsn = 'mysql:dbname=grocery; host=localhost';
$username = 'kenny';
$password = 'kc226975';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try{
	$db = new PDO($dsn,$username, $password, $options);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch (Exception $ex){
	die('You are not signed in!');
}
?>