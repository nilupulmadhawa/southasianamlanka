<?php
session_start();
include 'connection.php';

$poid = $_POST['po'];
$cheque = $_POST['cheque'];
$chequedate = $_POST['chequedate'];
$bank = $_POST['bank'];

$p = 0;
$result  = mysqli_query($conn,"SELECT * FROM pocheque");
while($row = mysqli_fetch_array($result)){
	GLOBAL $p;
	$p = $row[0];
}
$p = $p + 1;
$result  = mysqli_query($conn,"SELECT * FROM po WHERE PoID = $poid ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $po;
	$po = $row[2];
}

if(isset($_POST['chequedate'])){
$result = "INSERT INTO pocheque (ID, Number,Bank,Cheque_Date,PoID) VALUES ($p, '$cheque', '$bank', '$chequedate', '$po')";
mysqli_query($conn,$result);}

mysqli_close($conn);
header('location:ChequeIssue.php');
?>