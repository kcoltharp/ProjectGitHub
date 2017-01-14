<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
	<head>
	</head>
	<body>
<?php
	include("pages/dbinfo.inc.php");
	mysql_connect('localhost',$username,$password);
	@mysql_select_db("ebooks") or die( "Unable to select database");

	if(!$_POST['Submit'])
	{
		if(isset($_POST['user']) && isset($_POST['pwd']))
		{
			
			$user = htmlentities(trim($_POST['user']));
			$pwd = md5(htmlentities(trim($_POST['pwd'])));
			$sql = "SELECT * FROM `users` WHERE `user_name` LIKE '%$user%' LIMIT 0, 30";
			$sql2 = "SELECT * FROM `users` WHERE `pwd` LIKE '%$pwd%' LIMIT 0, 30";
			$search = mysql_query( $sql );
			$search2 = mysql_query($sql2);
			
			while($user_name = mysql_fetch_array( $search, MYSQL_BOTH )) 
			{
				while($passwd = mysql_fetch_array( $search2, MYSQL_BOTH ))
				{
					if($user_name['user_name'] === $user && $passwd['pwd'] === $pwd)
					{
						header("Location: index.php");
						exit(0);
					}
					else
					{
						?>
						<script type="text/javascript">
						alert("Username and/or Password do not match our records in the database!" );
						</script>
						<?php
						header("Location: new_login.php");
						exit(0);
					}
				}
				
			}
		}
		else
		{
			echo 'There is no user name or password set';
		}
	}
	else
	{
		?>
		<form method="post">
		Enter User Name: <input type="text" name="user"/><br /><br />
		Enter Password: <input type="password" name="pwd"/><br /><br />
		<input type="submit" name="Submit"/>
		</form>
		<?php
	}
?>
		
	</body>
</html>
