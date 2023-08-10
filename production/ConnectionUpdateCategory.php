<?php
include 'connection.php';
$product = $_POST['product'];
$cat = $_POST['cat'];

$sql2 = "UPDATE item SET Category_Cat_ID = $cat WHERE Item_ID = $product ";
	mysqli_query($conn,$sql2);
	header('location:UpdateCategory.php');
?>