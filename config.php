<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'crud');

	// initialize variables
	$name = "";
	$ic = "";
	$education = "";
	$document = "";
	$id = 0;
	$update = false;
	
	//CReate
	if (isset($_POST['save'])) 
	{
		$name = $_POST['name'];
		$ic = $_POST['ic'];
		$education = $_POST['education'];
		$document = $_POST['document'];

		mysqli_query($db, "INSERT INTO info (name, ic, education, document) VALUES ('$name', '$ic', '$education', '$document')"); 
		$_SESSION['message'] = "Data saved"; 
		header('location: index.php');
	}
	
	//Update
	if (isset($_POST['update'])) 
	{
	$id = $_POST['id'];
	$name = $_POST['name'];
	$ic = $_POST['ic'];
	$education = $_POST['education'];
	$document = $_POST['document'];
	

	mysqli_query($db, "UPDATE info SET name='$name', ic='$ic', education='$education', document='$document' WHERE id=$id");
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

		$currentDirectory = getcwd();
		$uploadDirectory = "/upload/";

		$errors = []; // Store errors here

		$fileExtensionsAllowed = ['jpeg','jpg','png','sql','doc','txt']; // These will be the only file extensions allowed 

		$fileName = $_FILES['document']['name'];
		$fileSize = $_FILES['document']['size'];
		$fileTmpName  = $_FILES['document']['tmp_name'];
		$fileType = $_FILES['document']['type'];

		$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
		
		  
		$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

		if ($didUpload)
		{
			echo "The file " . basename($fileName) . " has been uploaded";
			$conn=mysqli_connect("localhost","root","","crud");
			$query = "INSERT INTO info(Document) VALUES ('$fileName')";
			$res = mysqli_query($conn,$query);
			header("location:index.php");
		} 
		else 
		{
			echo "An error occurred. Please contact the administrator.";
		}
?>
