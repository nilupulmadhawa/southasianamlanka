<?php
session_start();
include 'connection.php';
$invoice = $_POST['invoice'];
$name = $_POST['repname'];
$invdate = date("Y-m-d");

date_default_timezone_set("Asia/Kolkata");
$alotime =   date("h:i:s");


$countrep = 0;
$result = mysqli_query($conn,"SELECT * FROM deliver");
while($row = mysqli_fetch_array($result)){
	GLOBAL $countrep;
	$countrep = $row[0];
}
	$countrep = $countrep + 1;

$result = "INSERT INTO deliver (ID, Employee_ID, Invoice_ID,DelDate,allocatedtime) VALUES ($countrep, $name, $invoice, '$invdate', '$alotime')";
mysqli_query($conn,$result);
$stat = 1;
$sql2 = "UPDATE invoice SET Allocated = $stat WHERE Inv_ID = $invoice ";
	mysqli_query($conn,$sql2);

mysqli_close($conn);
	header('location:DetailedReportInvoice.php');
?>