<?php
require_once 'core/init.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
		<?php
		//$user = DB::getInstance()->query("SELECT username FROM users WHERE username = ?", array('kenny'));
		$user = DB::getInstance()->get('users', array('username', '=', 'kenny'));
		
		if(!$user->count()){
			echo 'No user';			
		}
		else{
			echo 'OK!';
		}
		
		?>
	</body>
</html>
