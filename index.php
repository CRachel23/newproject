<?php  include('config.php'); ?>

<!--Update-->
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (mysqli_num_rows($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['Name'];
			$ic = $n['IC'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<h1><center>TESTING</center></H1>
</head>
<body>

	<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
	<?php endif ?>

<!--Create-->
	<form method="post" action="config.php"  enctype="multipart/form-data">
		<h4>Create Data</h4>
		
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="">
		</div>
		
		<div class="input-group">
			<label>IC</label>
			<input type="text" name="ic" value="">
		</div>
		
		<div class="input-group">
		<label>Education</label>
			<input type="text" name="education" value="">
		</div>
		
		<div class="input-group">
		<label>Document</label>
			<input type="file" name="document" value="">
		</div>
		
		<div class="input-group">
			<?php if ($update == true): ?>
			<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
			<?php else: ?>
			<button class="btn" type="submit" name="save" >Save</button>
			<?php endif ?>
		</div>
		
		<h4>Edit Data</h4>
		<!--newly added field-->
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<!--modified form fields-->
		Name:<input type="text" name="Name" value="<?php echo $name; ?>">
		IC:<input type="text" name="IC" value="<?php echo $ic; ?>"><br>
		Education:<input type="text" name="Education" value="<?php echo $education; ?>">
		Document:<input type="text" name="document" value="<?php echo $document; ?>">
	</form>
	
<!--Read-->
	<?php $results = mysqli_query($db, "SELECT * FROM info"); 
			$results2 = mysqli_query($db, "SELECT * FROM Document")
	?>

	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>IC</th>
				<th>Education</th>
				<th>Document</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		
		<?php while ($row = mysqli_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['Name']; ?></td>
				<td><?php echo $row['IC']; ?></td>
				<td><?php echo $row['Education']; ?></td>
				<td><?php echo $row['Document']; ?></td>
				<td>
					<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
				</td>
				<td>
					<a href="config.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>

	
</body>
</html>
