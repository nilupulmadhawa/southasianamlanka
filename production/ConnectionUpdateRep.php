<?php
include 'connection.php';
$product = $_POST['product'];
$cat = $_POST['cat'];

$sql2 = "UPDATE cus_profile SET Rep_Code = $cat WHERE Cus_ID = $product ";
	mysqli_query($conn,$sql2);
	header('location:UpdateProductRep.php');
?>
