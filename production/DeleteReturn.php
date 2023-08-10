<?php
include 'connection.php';
$id = $_GET['id'];
echo $id;

$sql = "DELETE FROM return_invoice WHERE ID = $id ";
mysqli_query($conn,$sql);
mysqli_close($conn);

header('location:Return.php');
?>