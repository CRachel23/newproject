<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'crud');

	// initialize variables
	$name = "";
	$ic = "";
	$id = 0;
	$update = false;
	
	//CReate
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$ic = $_POST['ic'];

		mysqli_query($db, "INSERT INTO info (name, ic) VALUES ('$name', '$ic')"); 
		$_SESSION['message'] = "Data saved"; 
		header('location: index.php');
	}
	
	//Update
	if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$ic = $_POST['ic'];

	mysqli_query($db, "UPDATE info SET name='$name', ic='$ic' WHERE id=$id");
	$_SESSION['message'] = "Data updated!"; 
	header('location: index.php');
	}
	
	//Delete
	if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM info WHERE id=$id");
	$_SESSION['message'] = "Data deleted!"; 
	header('location: index.php');
}