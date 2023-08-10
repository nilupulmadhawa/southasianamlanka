<?php 
include 'connection.php';
session_start();
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
//get the values
$supplier = $_POST['supplier'];
//enter data into the table
$today = date("Y-m-d");
$pocount = 0;
$result = mysqli_query($conn,"SELECT * FROM rep_po ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $pocount;
		$pocount = $row[0];
}
$pocount = $pocount + 1;
$result = "INSERT INTO rep_po (ID, CustomerName, podate, status, CompanyID) VALUES ($pocount, $supplier, '$today', 0, $company)";
mysqli_query($conn,$result);

$_SESSION['ponumber'] = $pocount;
$_SESSION['check'] = 1;

mysqli_close($conn);
header('location:POSecond.php');
?>