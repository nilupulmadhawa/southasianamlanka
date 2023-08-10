<?php
session_start();
$company = $_SESSION['company'];
include 'connection.php';
$qty = mysqli_real_escape_string($conn,$_POST['qty']);
$free = mysqli_real_escape_string($conn,$_POST['free']);
$product = mysqli_real_escape_string($conn,$_POST['product']);
$discount = mysqli_real_escape_string($conn,$_POST['discount']);
// $CUSID = mysqli_real_escape_string($conn,$_POST['cusname']);
$CUSID = 0;

$rowcount = 0;
//$result = mysqli_query($conn,"SELECT * FROM freeissue WHERE Item_ID = $product");
//$rowcount=mysqli_num_rows($result);
// if($rowcount == 0){
	$idf = 0;
	$result = mysqli_query($conn,"SELECT * FROM freeissue");
	while($row = mysqli_fetch_array($result)){
//		GLOBAL $idf;
		$idf = $row[0];
	}
	$idf = $idf + 1;
	$result = "INSERT INTO freeissue (ID, Item_ID, Qty, FreeIssue, discount, CompanyID)
	VALUES ($idf, $product, $qty, $free, $discount,$company)";
mysqli_query($conn,$result);
// }
//else if($rowcount > 0){
//	$sql2 = "UPDATE freeissue SET Qty = $qty WHERE Item_ID = $product ";
//	mysqli_query($conn,$sql2);
//	$sql3 = "UPDATE freeissue SET FreeIssue = $free WHERE Item_ID = $product ";
//	mysqli_query($conn,$sql3);
//	$sql3 = "UPDATE freeissue SET discount = $discount WHERE Item_ID = $product ";
//	mysqli_query($conn,$sql3);
//}
mysqli_close($conn);
header('location:FreeIssue.php');
?>
