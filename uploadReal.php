<?php

	
    $currentDirectory = getcwd();
    $uploadDirectory = "/upload/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png','sql','doc','txt']; // These will be the only file extensions allowed 

    $fileName = $_FILES['fileUpload']['name'];
    $fileSize = $_FILES['fileUpload']['size'];
    $fileTmpName  = $_FILES['fileUpload']['tmp_name'];
    $fileType = $_FILES['fileUpload']['type'];

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
	
	  
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didUpload)
	{
		echo "The file " . basename($fileName) . " has been uploaded";
		$conn=mysqli_connect("localhost","root","","testLogin");
		$query = "INSERT INTO files(fileName, filePath) VALUES ('$fileName', '$uploadPath')";
		$res = mysqli_query($conn,$query);
		header("location:../index.php");
    } 
	else 
	{
		echo "An error occurred. Please contact the administrator.";
    }
?>