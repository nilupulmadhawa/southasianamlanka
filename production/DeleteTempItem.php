<?php
session_start();
$company = $_SESSION['company'];
include 'connection.php';
$id = mysqli_real_escape_string($conn,$_GET['id']);
$mul = mysqli_real_escape_string($conn,$_GET['mul']);
echo $id;
$invoice = $_SESSION['invoice'];


$result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE invoice_ID = $invoice ");
while($row = mysqli_fetch_array($result)){
	$free = $row[7];
	$qty = $row[2];
	$itemid = $row[1];
}


$result = mysqli_query($conn, "SELECT * FROM multiprice WHERE ID = $mul");
while($row = mysqli_fetch_array($result)){
	$invqty = $row[2];
}


$newqty = $invqty + $qty + $free;
$sql2 = "UPDATE multiprice SET Qty = $newqty WHERE ID = $mul ";
mysqli_query($conn,$sql2);

$sql = "DELETE FROM temp_invoice WHERE Temp_Invoice_ID = $id ";
mysqli_query($conn,$sql);
mysqli_close($conn);
if($company == 3){
	header('location:NewInvoiceShop.php');
}
else{
	header('location:NewInvoice.php');
}
?>
