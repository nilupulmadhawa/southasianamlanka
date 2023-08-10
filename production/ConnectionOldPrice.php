<?php 
include 'connection.php';
$product = $_POST['product'];
$cost = $_POST['cost'];
$wp = $_POST['wp'];
$ret = $_POST['ret'];
$batch = $_POST['batch'];
$count = 0;
$result = mysqli_query($conn,"SELECT * FROM multiprice");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
	$count = $row[0];
}
$count = $count + 1;
$result = "INSERT INTO multiprice (ID, Item_ID, Qty, CostPrice, Wprice, RetailPrice, Status,batchID) VALUES ($count,$product,0,$cost,$wp,$ret,0,'$batch')";
mysqli_query($conn,$result);
$count = $count + 1;
mysqli_close($conn);
header('location:OldPrice.php')
?>