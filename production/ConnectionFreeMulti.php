<?php 
session_start();
$company = $_SESSION['company'];
include 'connection.php';
$qty = $_POST['qty'];  
$free = $_POST['free'];
$product = $_POST['product'];
$discount = $_POST['discount'];

$rowcount = 0;
$result = mysqli_query($conn,"SELECT * FROM freeissue WHERE Item_ID = $product");
$rowcount=mysqli_num_rows($result);

	$idf = 0;
	$result = mysqli_query($conn,"SELECT * FROM freeissue");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $idf;
		$idf = $row[0];
	}
	$idf = $idf + 1;
	$result = "INSERT INTO freeissue (ID, Item_ID, Qty, FreeIssue, discount, CompanyID) VALUES ($idf, $product, $qty, $free, $discount,$company)";
mysqli_query($conn,$result);


mysqli_close($conn);
header('location:FreeIssue.php');
?>