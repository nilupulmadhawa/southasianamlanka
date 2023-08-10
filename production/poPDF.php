<?php
session_start();
include 'connection.php';
$invoice = $_SESSION['poextendid'];
echo $invoice;
$sql2 = "UPDATE rep_po SET status = 1 WHERE ID = $invoice ";
	mysqli_query($conn,$sql2);
	header('location:PurchaseOrderDetailed.php');
?>