<?php
include 'connection.php';
$id = $_GET['id'];
echo $id;
$sql = "DELETE FROM jobcard_primary WHERE ID = $id ";
mysqli_query($conn,$sql);

header('location:pendingjobcard.php');
?>