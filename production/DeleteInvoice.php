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
	GLOBAL $itemid,$qty,$free,$multiid;
	$free = $row[2];
	$qty = $row[1];
	$itemid = $row[8];
	$multiid = $row[9];
}

$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multiid");
while($row = mysqli_fetch_array($result)){
	GLOBAL $invqty;
	$invqty = $row[2];
}
$newqty = $invqty + $qty + $free;

$sql2 = "UPDATE multiprice SET Qty = $newqty WHERE ID = $multiid ";
	mysqli_query($conn,$sql2);

	$steps = $steps + 1;
}

$sql = "DELETE FROM invoice WHERE Inv_ID = $id ";
mysqli_query($conn,$sql);

$sql = "DELETE FROM sub_invoice WHERE invoice_Inv_ID = $id ";
mysqli_query($conn,$sql);

$sql = "DELETE FROM temp_invoice WHERE Invoice_ID = $id ";
mysqli_query($conn,$sql);

$sql = "DELETE FROM deliver WHERE Invoice_ID = $id ";
mysqli_query($conn,$sql);

header('location:DetailedReportInvoice.php');
?>