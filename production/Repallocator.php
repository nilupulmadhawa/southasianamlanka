<?php
session_start();
include 'connection.php';
$id = $_POST['poid'];
$name = $_POST['repname'];
$invdate = date("Y-m-d");

$countrep = 0;
$result = mysqli_query($conn,"SELECT * FROM purchase_emp");
while($row = mysqli_fetch_array($result)){
	GLOBAL $countrep;
	$countrep = $row[0];
}
	$countrep = $countrep + 1;

$result = "INSERT INTO purchase_emp (ID, Emp_name, PoID,PoDate) VALUES ($countrep, '$name', $id, '$invdate')";
mysqli_query($conn,$result);

$sql2 = "UPDATE rep_po SET status = 2 WHERE ID = $id ";
	mysqli_query($conn,$sql2);


mysqli_close($conn);
	header('location:PurchaseOrderDetailed.php');
?>