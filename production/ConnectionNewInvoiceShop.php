<?php 
include 'connection.php';
session_start();
$invoice = $_SESSION['invoice'];
$product = $_POST['product'];
$qty = $_POST['qty'];
$multi = $_POST['multi'];


$result = mysqli_query($conn,"SELECT * FROM freeissue WHERE Item_ID = $product");
while($row = mysqli_fetch_array($result)){
	GLOBAL $qty,$free;
	$quantity = $row[2];
	$free = $row[3];	
}
$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $product");
while($row = mysqli_fetch_array($result)){
	GLOBAL $CostPrice,$RetPrice,$wprice;
	$CostPrice = $row[4];
	$RetPrice = $row[3];
	$wprice = $row[5];
}

echo $qty."<br/>";
echo $quantity."<br/>";
$freeq = 0;
$freeq = ($qty / $quantity );	
echo $freeq."<br/>";
$freeq = intval($freeq);
$freeq = $freeq * $free;

echo $freeq."<br/>";

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM temp_invoice");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
		$count = $row[0];
}
$count = $count + 1;
//insert data
$result = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID ,Qty, RetPrice, CostPrice, Wprice,Invoice_ID, multiID) 
VALUES ($count, $product, $qty, $RetPrice, $CostPrice, $wprice, $invoice, $multi)";
mysqli_query($conn,$result);

if($freeq > 0){
	$count = $count + 1;
	$result = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID ,Qty, RetPrice, CostPrice, Wprice,Discount,Invoice_ID, multiID) 
	VALUES ($count, $product, $freeq, 0, 0, 0, 100, $invoice, $multi)";
mysqli_query($conn,$result);
}





mysqli_close($conn);
header('location:NewInvoiceShop.php');
?>