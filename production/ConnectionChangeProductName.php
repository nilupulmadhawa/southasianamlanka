<?php
include 'connection.php';
$product = $_POST['product'];
echo $product;
$name = $_POST['name'];

$sql2 = "UPDATE item SET Name = '$name' WHERE Item_ID = $product ";
	mysqli_query($conn,$sql2);
	header('location:ChaneProductName.php');
?>