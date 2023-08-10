<?php
include 'connection.php';
$name = $_POST['name'];
$qty = $_POST['qty'];
$id = $_POST['id'];
echo $name;
echo $id;
$sql2 = "UPDATE rep_po_sub SET Qty = $qty WHERE Name = '$name' ";
	mysqli_query($conn,$sql2);
	header('location:PurchaseOrderDetailedExtend.php');
?>