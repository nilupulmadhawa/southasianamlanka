<?php 
session_start();
$company = $_SESSION['company'];
include 'connection.php';
$qty = $_POST['qty'];  
$free = $_POST['free'];
$cat = $_POST['cat'];
echo $cat;
$discount = $_POST['discount'];

$result = mysqli_query($conn,"SELECT * FROM item WHERE Category_Cat_ID = $cat");
$count=mysqli_num_rows($result);
$steps = 1;
while($steps <= $count){
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Category_Cat_ID = $cat LIMIT $steps");
while($row = mysqli_fetch_array($result)){
	GLOBAL $product;
	$product = $row[0]; 
}
echo $product;
$rowcount = 0;
$result = mysqli_query($conn,"SELECT * FROM freeissue WHERE Item_ID = $product");
$rowcount=mysqli_num_rows($result);
 if($rowcount == 0){
	$idf = 0;
	$result = mysqli_query($conn,"SELECT * FROM freeissue");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $idf;
		$idf = $row[0];
	}
	$idf = $idf + 1;
	$result = "INSERT INTO freeissue (ID, Item_ID, Qty, FreeIssue, discount, CompanyID) VALUES ($idf, $product, $qty, $free, $discount,$company)";
mysqli_query($conn,$result);
 }
else if($rowcount > 0){
	$sql2 = "UPDATE freeissue SET Qty = $qty WHERE Item_ID = $product ";
	mysqli_query($conn,$sql2);
	$sql3 = "UPDATE freeissue SET FreeIssue = $free WHERE Item_ID = $product ";
	mysqli_query($conn,$sql3);
	$sql3 = "UPDATE freeissue SET discount = $discount WHERE Item_ID = $product ";
	mysqli_query($conn,$sql3);
}
$steps = $steps + 1;
}
mysqli_close($conn);
header('location:FreeIssue.php');
?>