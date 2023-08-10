<?php
include 'connection.php';
$product = $_POST['product'];
$name = $_POST['name'];

$sql2 = "UPDATE cus_profile SET Name = '$name' WHERE Cus_ID = $product ";
	mysqli_query($conn,$sql2);
	header('location:ChageCustomerName.php');
?>