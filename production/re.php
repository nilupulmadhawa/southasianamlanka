<?php 
include 'connection.php';
$id = $_GET['id'];
echo $id;
$sql2 = "UPDATE cheque SET status = 2 WHERE ID = $id ";
	mysqli_query($conn,$sql2);
	header('location:cheque.php');
?>