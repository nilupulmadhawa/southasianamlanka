<?php 
session_start();
$company = $_SESSION['company']; 
$invoicenumber = $_SESSION['invoicenumber']; 
if($company == 3){
$invoice = $_SESSION['invoice'];}
else {
$invoice = $_SESSION['invoice'];}
include 'connection.php';
//---------------------------------------------------------------------------------
$invdate = date("Y-m-d");
$customer = $_SESSION['customer'] ;
$pemp = $_SESSION['pemp'];
$demp = $_SESSION['demp'];
$count = 0;
$result = mysqli_query($conn,"SELECT * FROM invoice");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
	$count = $row[0];
}
$count = $count + 1;

//$result = "INSERT INTO invoice (Inv_ID, InvDate,User_User_ID,Customer_id,CompanyID,	invoice) VALUES ($count, '$invdate', $pemp, $customer,$company,$invoicenumber)";
//mysqli_query($conn,$result);

$sql2 = "UPDATE invoice SET invoice = $invoicenumber WHERE Inv_ID = $invoice ";
	mysqli_query($conn,$sql2);
$sql2 = "UPDATE invoice SET deliver = 0 WHERE Inv_ID = $invoice ";
	mysqli_query($conn,$sql2);

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


//---------------------------------------------------------------------------------


$count = 0;
$result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE Invoice_ID =$invoice ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
	$count = $count + 1;
}

$steps = 1;
while($steps<=$count){

	$result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE Invoice_ID =$invoice LIMIT $steps ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $ItemID,$Qty,$RetPrice,$CostPrice,$Wprice,$Discount,$FreeIssue,$multiID;
		$ItemID = $row[1];
		$Qty = $row[2];
		$RetPrice = $row[3];
		$CostPrice = $row[4];
		$Wprice = $row[5];
		$Discount = $row[6];
		
		$multiID = $row[9];
		
	}
	echo $multiID;
	$stkmulti = 0;
	$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multiID");
while($row = mysqli_fetch_array($result)){
	GLOBAL $stkmulti;
	$stkmulti = $row['Qty'];
}
$newmaltistock = 0;
//$newmaltistock = $stkmulti - $Qty - $FreeIssue; 
$sql2 = "UPDATE multiprice SET Qty = $newmaltistock WHERE ID = $multiID ";
mysqli_query($conn,$sql2);
	
	$result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $ItemID");
while($row = mysqli_fetch_array($result)){
	GLOBAL $stk;
	$stk = $row['Qty'];
}


//echo $stk."</br>";
//$newstock = $stk - $Qty - $FreeIssue;
//echo $newstock."</br>";

//$sql2 = "UPDATE inventory SET qty = $newstock WHERE Item_Item_ID = $ItemID ";
//mysqli_query($conn,$sql2); 



	$vinidcount = 0;
	$result = mysqli_query($conn,"SELECT * FROM sub_invoice ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $vinidcount;
		$vinidcount = $row[0];
	}
	$vinidcount = $vinidcount + 1;
	echo $vinidcount;

	$result = "INSERT INTO sub_invoice (SubI_ID,Qty,RetPrice,CostPrice,Wprice,Discount,Invoice_Inv_ID,Item_Item_ID,multiID) VALUES ($vinidcount, $Qty, $RetPrice, $CostPrice, $Wprice, $Discount, $invoice, $ItemID, $multiID)";
	mysqli_query($conn,$result);

$steps = $steps + 1;

}
$_SESSION['chk'] = "notok";
mysqli_close($conn);
//header('location:Printng.php');
?>