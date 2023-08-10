<?php 
	include 'connection.php';
	$name = $_POST['name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$fax = $_POST['fax'];
	$email = $_POST['email'];
	$contact_per = $_POST['contactper'];

	
	$sql2 = "UPDATE supplier SET Address = '$address' WHERE Name = '$name' ";
	mysqli_query($conn,$sql2);
	
	$sql5 = "UPDATE supplier SET TPNo = '$contact' WHERE Name = '$name' ";
	mysqli_query($conn,$sql5);
	$sql = "UPDATE supplier SET Fax = '$fax' WHERE Name = '$name' ";
	mysqli_query($conn,$sql);
	$sq7 = "UPDATE supplier SET Email = '$email' WHERE Name = '$name' ";
	mysqli_query($conn,$sq7);
	$sq8 = "UPDATE supplier SET Contact_per = '$contact_per' WHERE Name = '$name' ";
	mysqli_query($conn,$sq8);
	mysqli_close($conn);
	header("location:UpdateSupplier.php");
?>