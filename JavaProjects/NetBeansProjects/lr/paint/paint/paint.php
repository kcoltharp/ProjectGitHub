<?php
include_once 'subMenu.php';
?>
<div class="paints">
	<h1 class="header">Model Paint Database</h1>
	<br /><br />
	<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		Manufacturer's Number:<input name="num" type="text"/><br/>
		Manufacturer's Name:<input name="name" type="text" /><br/>
		Sheen:
		<select>
			<option value="Gloss">Gloss</option>
			<option value="Semigloss">Semigloss</option>
			<option value="Flat">Flat</option>
		   </select><br/>
		Base:
		<select>
			<option value="Enamel">Enamel</option>
			<option value="Acrylic">Acrylic</option>
			<option value="Lacquer">Lacquer</option>
		   </select><br/>
		   FS #:<input name="fs#" type="text" />		   
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<input name="userfile" type="file" />
		<input type="submit" value="Submit" />
	</form>
	
</div>
