<?php
include 'connection.php';
$id = $_GET['id'];
echo $id;

$addcount = 0;
$result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE invoice_Inv_ID = $id ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $addcount;
	$addcount = $addcount + 1;
}

$steps = 1;
while($steps <= $addcount){

	$result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE invoice_Inv_ID = $id LIMIT $steps");
while($row = mysqli_fetch_array($result)){
	GLOBAL $itemid,$qty,$free,$multi;
	$free = $row[2];
	$qty = $row[1];
	$itemid = $row[8];
	$multi = $row[9];
}

$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $itemid AND ID = $multi");
while($row = mysqli_fetch_array($result)){
	GLOBAL $invqty;
	$invqty = $row[2];
}
$newqty = $invqty + $qty + $free;

$sql2 = "UPDATE multiprice SET Qty = $newqty WHERE Item_ID = $itemid AND ID = $multi ";
	mysqli_query($conn,$sql2);

	$steps = $steps + 1;
}

$sql2 = "UPDATE invoice SET deliver = 3 WHERE Inv_ID = $id ";
	mysqli_query($conn,$sql2);

header("location:InvCancle.php");

?>