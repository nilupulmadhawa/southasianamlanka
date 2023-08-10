<?php
session_start();
include 'connection.php';
$invoice = $_SESSION['invoice'];

$discount = 0 ;
$invoicetotal = $_SESSION['invoicetotal'];

$temptotal = 0;
$temptotal = 100 - $discount;
$temptotal = ($invoicetotal * $temptotal)/100;


//---------------------------------------------------------------------------------
$invdate = date("Y-m-d");
$customer = $_SESSION['customer'] ;
$pemp = $_SESSION['pemp'];
$demp = $_SESSION['demp'];
//echo "Deliver Invoice: ".$demp."<br/>";
$count = 0;
$nextNumber = 0;
$result = mysqli_query($conn,"SELECT * FROM invoice ORDER BY Inv_ID ASC");
while($row = mysqli_fetch_array($result)){
	//	GLOBAL $count;
	$count = $row[0];
	$nextNumber = $row[12];

}
$count = $count + 1;
$nextNumber = $nextNumber + 1;

//$result = "INSERT INTO invoice (Inv_ID, InvDate,User_User_ID,Customer_id,discount,total) VALUES ($count, '$invdate', $pemp, $customer,$discount,$temptotal)";
//mysqli_query($conn,$result);

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
		$FreeIssue = $row[7];
		$RetPrice = $row[3];
		$CostPrice = $row[4];
		$Wprice = $row[5];
		$Discount = $row[6];

		$multiID = $row[9];
		$imei = $row['imei'];

	}
	//echo "multi: ".$multiID."<br/>";
	$stkmulti = 0;
	$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multiID");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $stkmulti;
		$stkmulti = $row['Qty'];
	}
	$newmaltistock = 0;
	$newmaltistock = $stkmulti - $Qty - $FreeIssue;
	// $sql2 = "UPDATE multiprice SET Qty = $newmaltistock WHERE ID = $multiID ";
	// mysqli_query($conn,$sql2);

	$result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $ItemID");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $stk;
		$stk = $row['Qty'];
	}


	//echo $stk."</br>";
	// $newstock = $stk - $Qty - $FreeIssue;
	//echo $newstock."</br>";

	// $sql2 = "UPDATE inventory SET qty = $newstock WHERE Item_Item_ID = $ItemID ";
	// mysqli_query($conn,$sql2);


	$sql2 = "UPDATE invoice SET discount = $discount WHERE Inv_ID = $invoice ";
	mysqli_query($conn,$sql2);
	$sql2 = "UPDATE invoice SET total = $temptotal WHERE Inv_ID = $invoice ";
	mysqli_query($conn,$sql2);

	$sql2 = "UPDATE invoice SET invoice = $nextNumber WHERE Inv_ID = $invoice ";
	mysqli_query($conn,$sql2);

	// $sql2 = "UPDATE invoice SET BillID = $nextNumber WHERE Inv_ID = $invoice ";
	// mysqli_query($conn,$sql2);



	$vinidcount = 0;
	$result = mysqli_query($conn,"SELECT * FROM sub_invoice ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $vinidcount;
		$vinidcount = $row[0];
	}
	$vinidcount = $vinidcount + 1;
	//echo $vinidcount;

	$result = "INSERT INTO sub_invoice (SubI_ID,Qty,FreeIssue,RetPrice,CostPrice,Wprice,Discount,Invoice_Inv_ID,Item_Item_ID,multiID,imei) VALUES ($vinidcount, $Qty, $FreeIssue, $RetPrice, $CostPrice, $Wprice, $Discount, $invoice, $ItemID, $multiID,'$imei')";
	mysqli_query($conn,$result);

	$sql = "UPDATE inventory_sub SET Qty= 0 WHERE imei= '$imei' ";
	mysqli_query($conn, $sql);

	$steps = $steps + 1;

}
$InvoiceNumber = 0;
$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1 ORDER BY Inv_ID ASC");
while($row = mysqli_fetch_array($result)){
	$InvoiceNumber = $row[12];
}
$InvoiceNumber = $InvoiceNumber + 1;
mysqli_query($conn,"UPDATE invoice SET InvNumber = $InvoiceNumber WHERE Inv_ID = $invoice ");
//mysqli_query($conn,"UPDATE invoice SET status = 1 WHERE Inv_ID = $invoice ");
$sql2 = "UPDATE invoice SET Allocated = 1 WHERE Inv_ID = $invoice ";
mysqli_query($conn,$sql2);

$_SESSION['chk'] = "notok";
mysqli_close($conn);
header('location:Printng.php');

// log process
include 'functions/activity.php';
activity($_SESSION['id'],"Invoice Generated");
// end of log process

?>
