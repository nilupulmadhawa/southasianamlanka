<?php 
include 'connection.php';
$count = 0;
$result = mysqli_query($conn,"SELECT * FROM inventory");
while($row = mysqli_fetch_array($result)){
	$count = $count + 1;
}
//echo $count."<br/>";
$steps = 1;
$costprice = 0;
$retailprice = 0;
$wholesale = 0;
$qty = 0;
while($steps <= $count){
	$qty = 0;
	$result = mysqli_query($conn,"SELECT * FROM inventory LIMIT $steps");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $itemid,$qty;
		$itemid = $row[5];
		
		$qty = $row[4];
	}
	echo $qty."<br/>";
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $costprice,$retailprice,$wholesale;
	
		$costprice = $row[4];
		$retailprice = $row[3];
		$wholesale = $row[5];
		
	}
	//o=echo $itemid."</br>";
	//echo $costprice."</br>";
	$idcount = 0;
$result = mysqli_query($conn,"SELECT * FROM multiprice");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $idcount;
		$idcount = $row[0];
	}
	$idcount = $idcount + 1;
	//echo $idcount."<br/>";
$result = "INSERT INTO multiprice (ID, Item_ID, Qty, CostPrice, Wprice, RetailPrice) VALUES ($idcount, $itemid, $qty, '$costprice', '$wholesale', '$retailprice')";
mysqli_query($conn,$result);	
	$steps = $steps + 1;
}

mysqli_close($conn);
?>