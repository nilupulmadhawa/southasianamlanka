<?php
include 'connection.php';
$id = $_GET['id'];
echo $id;

$sql = "DELETE FROM item WHERE Item_ID = $id ";
mysqli_query($conn,$sql);
mysqli_close($conn);

header('location:ProductList.php');
?>