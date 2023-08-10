<?php
include 'connection.php';
$supplier = $_POST['supplier'];
$ddate = $_POST['ddate'];

$sql2 = "UPDATE supplier SET DueDate = $ddate WHERE Sup_ID = $supplier ";
	mysqli_query($conn,$sql2);
	header('location:SupplierDueDate.php');
?>