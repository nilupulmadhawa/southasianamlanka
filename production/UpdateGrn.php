<?php 
include 'connection.php';
$name = $_POST['name'];
$free = $_POST['free'];
$dis = $_POST['dis'];
$qty = $_POST['qty'];

$sql2 = "UPDATE rep_po_sub SET FreeIssue = $free WHERE ID = $name ";
mysqli_query($conn,$sql2);
$sql2 = "UPDATE rep_po_sub SET Discount = $dis WHERE ID = $name ";
mysqli_query($conn,$sql2);
$sql2 = "UPDATE rep_po_sub SET Qty = $qty WHERE ID = $name ";
mysqli_query($conn,$sql2);
mysqli_close($conn);
header('location:GrnProceed.php');
?>