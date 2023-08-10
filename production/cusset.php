<?php
session_start();
include 'connection.php';
$cus = $_POST['cus'];
$company = $_SESSION['company'];
$_SESSION['cus'] = $cus;

$id = 0;
$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE CompanyID = $company ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $id;
	$id = $row[11];
}
	$id = $id + 1;
$_SESSION['reID'] = $id;
echo $id;	
mysqli_close($conn);
header('location:Return.php');
?>