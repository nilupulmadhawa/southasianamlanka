<?php
session_start();
$company = $_SESSION['company'];
$name  = $_POST['name'];
 
include 'connection.php';
$id = 0;
$result = mysqli_query($conn,"SELECT * FROM supplier_cat");
while($row = mysqli_fetch_array($result)){
	GLOBAL $id;
	$id = $row[0];
}
	$id = $id + 1;

$result = "INSERT INTO supplier_cat (ID, Cat, CompanyID) VALUES ($id, '$name', $company)";
mysqli_query($conn,$result);
mysqli_close($conn);
//header('location:NewSupplierCat.php');
?>