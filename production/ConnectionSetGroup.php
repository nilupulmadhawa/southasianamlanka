<?php 
session_start();
$company = $_SESSION['company'];
include 'connection.php';
$grping = $_POST['grping'];
$product = $_POST['product'];
$id = 0;
$sql2 = "UPDATE item SET grouping = $grping WHERE Item_ID = $product ";
mysqli_query($conn,$sql2);
mysqli_close($conn);
header('location:SetGroup.php');
?>