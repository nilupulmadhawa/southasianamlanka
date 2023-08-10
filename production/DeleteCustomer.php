<?php
include 'connection.php';
$id = $_GET['id'];
echo $id;

$sql = "DELETE FROM customer WHERE 	Cus_ID = $id ";
mysqli_query($conn,$sql);

$sql = "DELETE FROM cus_profile WHERE 	Cus_ID = $id ";
mysqli_query($conn,$sql);



header('location:CustomerList.php');
?>