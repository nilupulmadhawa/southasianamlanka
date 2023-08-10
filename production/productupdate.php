<?php 
	include 'connection.php';
	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$rprice = mysqli_real_escape_string($conn,$_POST['rprice']);
	$cprice = mysqli_real_escape_string($conn,$_POST['cprice']);
	$wprice = mysqli_real_escape_string($conn,$_POST['wprice']);
	$des = mysqli_real_escape_string($conn,$_POST['des']);
	$itemcode = mysqli_real_escape_string($conn,$_POST['itemcode']);
	$reorder = mysqli_real_escape_string($conn,$_POST['reorder']);
//	$reorder = 0;
	$mrq = 0;
	$max = 0;

    
	
	$sql2 = "UPDATE item SET RetPrice = $rprice WHERE Name = '$name' ";
	mysqli_query($conn,$sql2);
	$sql3 = "UPDATE item SET CostPrice = $cprice WHERE Name = '$name' ";
	mysqli_query($conn,$sql3);
	$sql6 = "UPDATE item SET Wprice = $wprice WHERE Name = '$name' ";
	mysqli_query($conn,$sql6);
	$sql4 = "UPDATE item SET Reorder_lvl = '$reorder' WHERE Name = '$name' ";
	mysqli_query($conn,$sql4);
	$sql5 = "UPDATE item SET MRQ = '$mrq' WHERE Name = '$name' ";
	mysqli_query($conn,$sql5);
	$sql = "UPDATE item SET MaxQ = '$max' WHERE Name = '$name' ";
	mysqli_query($conn,$sql);
    $sql = "UPDATE item SET Des = '$des' WHERE Name = '$name' ";
	mysqli_query($conn,$sql);
    $sql = "UPDATE item SET ItemCode = '$itemcode' WHERE Name = '$name' ";
	mysqli_query($conn,$sql);
    $sql = "UPDATE item SET Reorder_lvl = '$reorder' WHERE Name = '$name' ";
	mysqli_query($conn,$sql);


    

	mysqli_close($conn);
	header("location:UpdateProduct.php");
?>