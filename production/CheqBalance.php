<?php
include 'connection.php';
$invoice = $_POST['invoice'];
$balance = $_POST['balance'];
$result1 = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoice ");
while($row1= mysqli_fetch_array($result1)){
	GLOBAL $qty,$wp,$Discount,$t;
	$qty = $row1[1];
	$wp = $row1[5];
	$Discount = $row1[6];
	$sub = (100-$Discount);
	$sub = $sub * $qty *$wp;
	$sub = $sub/100;
	$t = $t + $sub;
}
$result1 = mysqli_query($conn,"SELECT * FROM invoice WHERE Inv_ID = $invoice ");
while($row1= mysqli_fetch_array($result1)){
	GLOBAL $bal;
	$bal = $row1[6];
}
$netbal = $bal + $balance;
echo $netbal."<br/>";
if($balance < ($t - $bal)){
$sql2 = "UPDATE invoice SET Balance = $netbal WHERE Inv_ID = $invoice ";
mysqli_query($conn,$sql2);
}
mysqli_close($conn);
header('location:realized.php');
?>