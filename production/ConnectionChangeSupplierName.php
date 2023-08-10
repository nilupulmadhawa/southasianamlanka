<?php
include 'connection.php';
$product = $_POST['product'];
$name = $_POST['name'];

$sql2 = "UPDATE supplier SET Name = '$name' WHERE Sup_ID = $product ";
	mysqli_query($conn,$sql2);
	header('location:ChangeSupplierName.php');
?>