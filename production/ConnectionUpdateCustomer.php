<?php 
	include 'connection.php';
	$name = $_POST['name'];
	$address = $_POST['address'];
//	$city = $_POST['city'];
//	$district = $_POST['district'];
	$route = $_POST['route'];
	$contact = $_POST['contact'];
	$LandLIne = $_POST['LandLIne'];
//	$email = $_POST['email'];

	$credit_limit = $_POST['credit_limit'];
	$credit_period = $_POST['credit_period'];

	
	$sql2 = "UPDATE cus_profile SET Address = '$address' WHERE Name = '$name' ";
	mysqli_query($conn,$sql2);

	$sql4 = "UPDATE cus_profile SET Route = '$route' WHERE Name = '$name' ";
	mysqli_query($conn,$sql4);
	$sql5 = "UPDATE cus_profile SET TPNo = '$contact' WHERE Name = '$name' ";
	mysqli_query($conn,$sql5);
	$sql = "UPDATE cus_profile SET LandLIne = '$LandLIne' WHERE Name = '$name' ";
	mysqli_query($conn,$sql);
//	$sq7 = "UPDATE cus_profile SET Email = '$email' WHERE Name = '$name' ";
//	mysqli_query($conn,$sq7);


	$sql3 = "UPDATE cus_profile SET credit_limit = $credit_limit WHERE Name = '$name' ";
	mysqli_query($conn,$sql3);
	$sql6 = "UPDATE cus_profile SET credit_period = $credit_period WHERE Name = '$name' ";
	mysqli_query($conn,$sql6);

	mysqli_close($conn);
	header("location:UpdateCustomers.php");
?>