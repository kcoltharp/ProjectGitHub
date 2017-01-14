<?php
require_once 'app/init.php';
require_once 'login.php';
session_start();

if(logged_in()){
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Kenny's-Spot Grocery List</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/main.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="list">
			<h1 class="header">Grocery List</h1>
			<?php
				$itemsQuery = $db->prepare("	
					   SELECT id, name, done 
					   FROM items
					   ");

				$itemsQuery->execute();

				$items = $itemsQuery->rowCount() ? $itemsQuery : [];
				if(!empty($items)): ?>
					<ul class="items">
						<?php foreach($items as $item): ?>
							<li>
								<span class="item <?php echo $item['done'] ? ' done' : ''  ?>"><?php echo $item['name']; ?></span>
								<?php if(!$item['done']): ?>
									<a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="items done-button">Mark as done</a>
								<?php endif; ?>
									<a href="mark.php?as=delete&item=<?php echo $item['id']; ?>" class="items delete-button">Remove item</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<p>You haven't added any items yet!</p>
				<?php endif; ?>
					<form class="item-add" action="add.php" method="post">
						<input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required="yes">
						<input type="submit" value="Add" class="submit">
						<input type="submit" value="Logout" class="submit">
					</form>
		</div>
	</body>
<?php 
}
else{ 
	session_unset();
?>
	<form class="login" action="login.php" method="post">
		<center>
			<input type="text" name="username" placeholder="Enter your username here." class="login-input" autocomplete="off"><br/>
			<input type="password" name="password"  placeholder="Enter your password here." class="login-input" autocomplete="off"><br/>
			<input type="submit" value="Login" class="login-submit">
		</center>	
	</form>
<?php
}
?>
</html>