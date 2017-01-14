<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
?>
<div class="list">
	<h1 class="header">Kenny's To Do List</h1>
<?php $itemsQuery = $db->prepare(" SELECT id, name, done FROM michelleslist");
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
			</form>
</div>
<?php include 'includes/overall/footer.php'; ?>