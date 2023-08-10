<?php 
include 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM rep_po_sub WHERE ID = $id ";
mysqli_query($conn,$sql);
mysqli_close($conn);
header('location:POSecond.php');
?>