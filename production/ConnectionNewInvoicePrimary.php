<?php
session_start();
$id1 = $_SESSION['id'];
$company = 0;
include 'connection.php';
$customer = mysqli_real_escape_string($conn,$_POST['customer']);
$billID = mysqli_real_escape_string($conn,$_POST['billID']);
$_SESSION['customer'] = mysqli_real_escape_string($conn,$_POST['customer']);
$invdate = date("Y-m-d");

$result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = $customer ");
while($row = mysqli_fetch_array($result)){
	$rep = $row[17];
}

$pemp = $id1;
$_SESSION['pemp'] = $pemp;
// $demp = $id1;
// $_SESSION['demp'] = $demp;

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM invoice");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
	$count = $row[0];
}
$count = $count + 1;

$result = "INSERT INTO invoice (Inv_ID, InvDate,User_User_ID,Customer_id,BillID) VALUES ($count, '$invdate', $pemp, $customer,'$billID')";
mysqli_query($conn,$result);

$count1 = 0;
$result = mysqli_query($conn,"SELECT * FROM deliver");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count1;
	$count1 = $row[0];
}
$count1 = $count1 + 1;

// $result = "INSERT INTO deliver (ID, Employee_ID, Invoice_ID) VALUES ($count1, $demp, $count)";
// mysqli_query($conn,$result);

$_SESSION['t'] = 0;

$_SESSION['invoice'] = $count;
$_SESSION['chk'] = "ok";
echo $count;
//delete old dump data
$sql = "DELETE FROM temp_invoice WHERE Invoice_ID = $count ";
mysqli_query($conn, $sql);
mysqli_close($conn);
header('location:NewInvoice.php');
?>
