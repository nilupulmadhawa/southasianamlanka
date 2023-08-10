<?php 
session_start();
$itemgroup = $_SESSION['itemgroup'];
include 'connection.php';
$product = $_POST['product'];
echo "Product ID: ".$product."<br/>";
$qty = $_POST['qty'];
$check = 0;
if (isset($_POST['freesec'])){
	
$freesec = $_POST['freesec'];}

if (isset($_POST['freeissue'])){
	
$freeissue = $_POST['freeissue'];}

echo "Free Issue ID: ".$freeissue."<br/>";

if (isset($_POST['multi'])){
	
$multiID = $_POST['multi'];}
else {
	$multiID = 0;
}
echo $freeissue."<br/>";
$invoice = $_SESSION['invoicewater'];

function group($itemid){
	include 'connection.php';
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $g;
		$g = $row[14];
	}
	return $g;
	mysqli_close($conn);
}

include 'functions/quantity.php';
$multiqty = productqty($product);
echo "item stock quantity: ".$multiqty."<br/>";



$check = 0;
$itemcount = 0;
$itemfree = 0;
$result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice ");
while($row = mysqli_fetch_array($result)){
	$check = group($row[1]);
	if($check == $itemgroup && $row[6] != 100){
		$itemcount = $itemcount + $row[2];
	}
	if($check == $itemgroup && $row[6] == 100){
		$itemfree = $itemfree + $row[2];
	}
}

$result = mysqli_query($conn,"SELECT * FROM freeissue WHERE ID = $freesec ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $quantity,$f,$discount;
	$quantity = $row[2];
	$f = $row[3];
	$discount = $row[4];
	
}

$tempitemcount = 0;
echo $quantity."<br/>";
echo "total item count: ".$itemcount."<br/>";
echo "total free issue: ".$itemfree."<br/>";
$tempitemcount = $itemcount -($quantity * $itemfree);

echo "rest: ".$tempitemcount."<br/>";
$tqty = 0;
$tqty = $qty;
$qty = $qty + $tempitemcount;
echo "quantity: ".$qty."<br/>";
$freeq = 0;
$freeq = $qty / $quantity;
$freeq = intval($freeq);
$freeq = $freeq * $f;
$qty = $tqty;

//item data
$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multiID");
while($row = mysqli_fetch_array($result)){
	GLOBAL $CostPrice,$RetPrice,$wprice;
	$CostPrice = $row[3];
	$RetPrice = $row[5];
	$wprice = $row[4];
}
//temp invoice 
$count = 0;
$result = mysqli_query($conn,"SELECT * FROM temp_invoice ORDER BY Temp_Invoice_ID ASC");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
		$count = $row[0];
}
$count = $count + 1;
if($multiqty >= ($qty+$freeq)){
//insert data
$result = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID ,Qty, RetPrice, CostPrice, Wprice,Discount,Invoice_ID, multiID) 
VALUES ($count, $product, $qty, $RetPrice, $CostPrice, $wprice, $discount, $invoice, $multiID)";
mysqli_query($conn,$result);



if($freeq > 0){
	$count = $count + 1;
	$result = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID ,Qty, RetPrice, CostPrice, Wprice,Discount,Invoice_ID, multiID) 
	VALUES ($count, $freeissue, $freeq, 0, 0, 0, 100, $invoice, $multiID)";
mysqli_query($conn,$result);
}
}
else{
	$_SESSION['error'] = 1;
}
mysqli_close($conn);

header('location:NewInvoiceWater.php');
?>