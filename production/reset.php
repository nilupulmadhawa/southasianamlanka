<?php
include 'connection.php';
$count = 0;
$result = mysqli_query($conn,"SELECT * FROM item");
while($row = mysqli_fetch_array($result)){
	$count = $count + 1;
}
$steps = 1;
while($steps<=$count){
	$result = mysqli_query($conn,"SELECT Item_ID,RetPrice,CostPrice,Wprice FROM item LIMIT $steps ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $Item_ID,$RetPrice,$CostPrice,$Wprice;
	$Item_ID = $row[0];
	$RetPrice = $row[1];
	$CostPrice = $row[2];
	$Wprice = $row[3];
}

$Inven_id = 0;
$result = mysqli_query($conn,"SELECT * FROM inventory");
while($row = mysqli_fetch_array($result)){
	GLOBAL $Inven_id;
	$Inven_id = $Inven_id +1;
}
$Inven_id = $Inven_id +1;

$result = "INSERT INTO inventory (Inventory_ID, CostPrice, RetPrice, Wprice, Qty, Item_Item_ID) VALUES ($Inven_id, $CostPrice, $RetPrice, $Wprice, 100, $Item_ID)";
mysqli_query($conn,$result);

$steps = $steps + 1;
}
mysqli_close($conn);
header('location:InitialInventory.php');
?>