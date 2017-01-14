<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>
<div class="paint-list">
	<h1 class="header">Model Paint Database</h1>
		<?php include 'includes/subMenu.php'; ?>
	<br /><br />
		<?php $itemsQuery = $db->prepare(" SELECT id, num, name, sheen, base, fs#, image FROM model_paint");
			$itemsQuery->execute();
			$items = $itemsQuery->rowCount() ? $itemsQuery : [];
			if(!empty($items)): ?>
				<table class="paint-items">
					<tr>
						<th>
							Manufacturer Number
						</th>
					</tr>
					<tr>
						<th>
							Manufacturer Name
						</th>
					</tr>
					<tr>
						<th>
							Sheen
						</th>
					</tr>
					<tr>
						<th>
							Base
						</th>
					</tr>
					<tr>
						<th>
							FS #
						</th>
					</tr>
					<tr>
						<th>
							Paint Image
						</th>
					</tr>
					<?php foreach($items as $item): ?>
					<tr>
						<td class="paint-item <?php echo $item['done'] ? ' done' : ''  ?>"><?php echo $item['name']; ?></td>
						<td><a href="mark.php?as=delete&item=<?php echo $item['id']; ?>" class="items delete-button">Remove item</a></td>
					</tr>
					<?php endforeach; ?>
				</table>
			<?php else: ?>
				<p>You haven't added any items yet!</p>
			<?php endif; ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<form class="paint-add" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<ul class="">
			<li>
				<span>
					Manufacturer's Number:<input class="textbox" name="num" type="text"/><br/>
				</span>
			</li>
				<li>	
				<span class="">
					Manufacturer's Name:<input class="textbox" name="name" type="text" /><br/>
				</span>				
			</li>
			<li>
				<span class="">
					Sheen:
					<select class="option textbox" name="sheen">
						<option value="Gloss">Gloss</option>
						<option value="Semigloss">Semigloss</option>
						<option value="Flat">Flat</option>
					   </select><br/>
				</span>
			</li>
			<li>
				<span class="">
					Base:
					<select class="option-base textbox" name="base">
						<option value="Enamel">Enamel</option>
						<option value="Acrylic">Acrylic</option>
						<option value="Lacquer">Lacquer</option>
					   </select><br/>
				</span>
			</li>
			<li>
				<span class="">
					FS #:<input class="textbox" name="fs#" type="text" /><br />
				</span>
			</li>
			<li>
				<span class="">
					Image file:<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
					<input name="image" type="file" /><br /><br />
				</span>
			</li>
			<li>
				<span class="paint-submit">
					<input class="submit" type="submit" value="Submit" />
				</span>
			</li>
			
		</ul>
	</form>
	<?php
	// check if a file was submitted
	if((!isset($_POST['num'])) && (!isset($_POST['name'])) && (!isset($_POST['sheen'])) && (!isset($_POST['base'])) && (!isset($_POST['fs#']))){
		echo "<p>Please ensure all fields are filled out.</p>";
	}elseif(!isset($_FILES['image'])){
		echo '<p>Please select a file</p>';
	}
	else{
		try{
			$msg = upload();  //this will upload your image
			echo $msg;  //Message showing success or failure.
		}catch(Exception $e){
			echo $e->getMessage();
			echo 'Sorry, could not upload file';
		}
	}
	?>
</div>
