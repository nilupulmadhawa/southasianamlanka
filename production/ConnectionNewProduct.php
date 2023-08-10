<?php
session_start();
include 'connection.php';
$company = $_SESSION['company'];
$code  = mysqli_real_escape_string($conn,$_POST['pcode']);
$name  = mysqli_real_escape_string($conn,$_POST['name']);
$price = mysqli_real_escape_string($conn,$_POST['price']);
$wprice = mysqli_real_escape_string($conn,$_POST['wprice']);
$cprice = mysqli_real_escape_string($conn,$_POST['cprice']);
$mrq = 0;
$cat = mysqli_real_escape_string($conn,$_POST['cat']);
$des = mysqli_real_escape_string($conn,$_POST['des']);
$rlvl = mysqli_real_escape_string($conn,$_POST['rlvl']);

$batch = mysqli_real_escape_string($conn,$_POST['batch']);
$supplier = mysqli_real_escape_string($conn,$_POST['supplier']);

$max = 0; 
$discount = 0; 
//free issue 
$qty = 0;  
$free = 0;  
//end of free issue

$id = 0;
$result = mysqli_query($conn,"SELECT * FROM item ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $id;
	$id = $row[0];
}
	$id = $id + 1;
	echo $id;
$result = "INSERT INTO item (Item_ID, ItemCode, Name, RetPrice, CostPrice, Wprice, Reorder_lvl, MRQ, MaxQ, BarCode, Category_Cat_ID, CalculatedPrice, Supplier_ID, CompanyID, grouping, Des) 
VALUES ($id, '$code', '$name', $price, $cprice, $wprice, $rlvl, $mrq, $max,  'NULL', $cat, 0, $supplier, $company, 0, '$des')";

if (mysqli_query($conn, $result)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $result . "<br>" . mysqli_error($conn);
}
//multiprice for the database
$id1 = 0;
$result = mysqli_query($conn,"SELECT * FROM multiprice ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $id1;
	$id1 = $row[0];
}
	$id1 = $id1 + 1;
	echo $id1;
$result = "INSERT INTO multiprice (ID, Item_ID, Qty, CostPrice, Wprice, RetailPrice, Status, discount,batchID) VALUES ($id1, $id, 0, $cprice, $wprice, $price, 0, 0, '$batch')";
if (mysqli_query($conn, $result)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $result . "<br>" . mysqli_error($conn);
}
//end of multiprice for the database
//free issue to databse
$idf = 0;
$result = mysqli_query($conn,"SELECT * FROM freeissue");
while($row = mysqli_fetch_array($result)){
	GLOBAL $idf;
	$idf = $row[0];
}
	$idf = $idf + 1;
	echo $idf;
$result = "INSERT INTO freeissue (ID, Item_ID, Qty, FreeIssue, discount, CompanyID) VALUES ($idf, $id, $qty, $free, $discount, $company)";
if (mysqli_query($conn, $result)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $result . "<br>" . mysqli_error($conn);
}
//end of free issue
mysqli_close($conn);

header('location:NewProduct.php');
?>