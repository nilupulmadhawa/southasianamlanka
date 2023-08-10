<?php 
include 'connection.php';
$sql2 = "DELETE FROM multiprice ";
mysqli_query($conn,$sql2);

mysqli_close($conn);
?>