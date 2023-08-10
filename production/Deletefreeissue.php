<?php
include 'connection.php';
$id = $_GET['id'];
//echo $id;
$sql = "DELETE FROM freeissue WHERE ID = $id ";
mysqli_query($conn,$sql);
header('location:FreeIssue.php');
?>