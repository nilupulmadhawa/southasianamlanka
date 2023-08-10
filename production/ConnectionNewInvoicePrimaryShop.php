<?php
session_start();
$id1 = $_SESSION['id']; 
$company = $_SESSION['company']; 
include 'connection.php';
$customer = $_POST['customer'];
if($_POST['CusName'] != NULL){
	$customer = $_POST['CusName'];
}

$_SESSION['customer'] = $_POST['customer'];
$invdate = date("Y-m-d");

$pemp = $id1;
$_SESSION['pemp'] = $id1;
$demp = $id1;
$_SESSION['demp'] = $id1;

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM invoice");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
	$count = $row[0];
}
$count = $count + 1;

if($_POST['CusName'] != NULL){
	$result = "INSERT INTO invoice (Inv_ID, InvDate,User_User_ID,Customer_id,deliver,CompanyID,type,AltName) VALUES ($count, '$invdate', $pemp, 0 ,1, $company, 2, '$customer' )";
mysqli_query($conn,$result);

}
else {
	$result = "INSERT INTO invoice (Inv_ID, InvDate,User_User_ID,Customer_id,deliver,CompanyID,type) VALUES ($count, '$invdate', $pemp, $customer, 1, $company, 1 )";
mysqli_query($conn,$result);
}


$count1 = 0;
$result = mysqli_query($conn,"SELECT * FROM deliver");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count1;
	$count1 = $row[0];
}
$count1 = $count1 + 1;

//$result = "INSERT INTO deliver (ID, Employee_ID, Invoice_ID) VALUES ($count1, $demp, $count)";
//mysqli_query($conn,$result);

$_SESSION['t'] = 0;
if($company == 3) {
$_SESSION['invoice'] = $count;}
else {
$_SESSION['invoice'] = $count;}

$_SESSION['chk'] = "ok";
echo $count;
//delete old dump data
$sql = "DELETE FROM temp_invoice WHERE Invoice_ID = $count ";
mysqli_query($conn, $sql);
mysqli_close($conn);
echo "company: ".$company;

	header('location:NewInvoiceShop.php');


?>