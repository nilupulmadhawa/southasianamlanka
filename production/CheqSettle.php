<?php 
include 'connection.php';
$id = $_GET['id'];
echo $id;
$sql2 = "UPDATE invoice SET status = 1 WHERE Inv_ID = $id ";
mysqli_query($conn,$sql2);
mysqli_close($conn);
header('location:realized.php');
?>