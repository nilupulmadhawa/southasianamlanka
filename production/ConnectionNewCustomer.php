<?php
session_start();
include 'connection.php';
$company = $_SESSION['company'];

$companyname  = mysqli_real_escape_string($conn,$_POST['companyname']);
$name  = mysqli_real_escape_string($conn,$_POST['name']);
$address = mysqli_real_escape_string($conn,$_POST['address']);

$contact = mysqli_real_escape_string($conn,$_POST['contact']);



$route = mysqli_real_escape_string($conn,$_POST['route']);
$cat = mysqli_real_escape_string($conn,$_POST['cat']);
$c_limit = mysqli_real_escape_string($conn,$_POST['c_limit']);
$c_period = mysqli_real_escape_string($conn,$_POST['c_period']);

$cuscode = 0;
$repcode = 0;
$land = mysqli_real_escape_string($conn,$_POST['land']);


include 'connection.php';
$id = 0;
$result = mysqli_query($conn,"SELECT * FROM customer");
while($row = mysqli_fetch_array($result)){
	GLOBAL $id;
	$id = $row[0];
}
$id = $id + 1;
$result = "INSERT INTO customer (Cus_ID, UserName, Password, Status, Online, CompanyID) VALUES ($id, '$name', 'NULL', 1, 0, $company)";
if (mysqli_query($conn, $result)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $result . "<br>" . mysqli_error($conn);
}

$result = "INSERT INTO cus_profile (Cus_ID, Name, Category, Address, City, District, Route, TPNo, Customer_Cus_ID, CompanyID, credit_limit, credit_period, LandLIne, Customer_Code, Rep_Code, CompanyName)
VALUES ($id, '$name', '$cat', '$address', '0', '0', '$route', '$contact', '$id', $company, $c_limit, $c_period, '$land', '$cuscode',' $repcode', '$companyname')";
if (mysqli_query($conn, $result)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $result . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header('location:NewCustomer.php');
?>
